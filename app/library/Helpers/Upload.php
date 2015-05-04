<?php

namespace App\Helpers;

use App\Models\Attachment;

class Upload extends HelperBase
{
    const ERR_NOLIGIN = 101;
    const ERR_NOFILE = 102;
    const ERR_NOTALLOWED = 103;
    const ERR_TOOLARGE = 104;
    const ERR_SAVEFAILED = 105;

    public static function dir()
    {
        $config = self::get('config');
        $dirRule = $config->application->upload->dirRule;

        return date($dirRule);
    }

    public static function path($path)
    {
        $config = self::get('config');
        $basePath = $config->application->upload->basePath;

        return $basePath . '/' . ltrim($path, '/');
    }

    public static function url($path)
    {
        $config = self::get('config');
        $baseUri = $config->application->upload->baseUri;
        $return = $baseUri . ltrim($path, '/');

        if ((substr($return, 0, 7) != 'http://') && substr($return, 0, 8) != 'https://') {
            $request = self::getShared('request');
            $httpHost = $request->getHttpHost();
            $return = 'http://' . $httpHost . '/' . ltrim($return, '/');
        }

        return $return;
    }

    public static function save($keyName, $allowTypes = array())
    {
        $auth = self::getShared('auth');
        if ( ! $auth->isLogined())
            return self::ERR_NOLIGIN;

        $config = self::getShared('config');

        if (is_string($allowTypes)) {
            $allowTypes = preg_split('/[\s|,]+/', $allowTypes);
        }

        $request = self::getShared('request');
        foreach ($request->getUploadedFiles() as $file) {
            if ($file->getKey() != $keyName) continue;

            $name = $file->getName();
            $ext = self::getExt($name);
            if (count($allowTypes) > 0 && ! in_array($ext, $allowTypes))
                return self::ERR_NOTALLOWED;

            $size = $file->getSize();
            $sizeLimit = $config->application->upload->sizeLimit;
            if ($size > $sizeLimit)
                return self::ERR_TOOLARGE;

            $dir = self::dir();
            $realDir = self::path($dir);
            if ( ! is_dir($realDir))
                mkdir($realDir, 0777, TRUE);

            $type = $file->getRealType();
            $saveName = self::getName($ext);
            $path = $dir . $saveName;
            $realPath = self::path($path);

            $isImage = substr($type, 0, 6) == 'image/';
            $width = $height = NULL;
            if ($isImage)
                list($width, $height, $t, $a) = getimagesize($file->getTempName());

            $dispatcher = self::getShared('dispatcher');
            if ($file->moveTo($realPath)) {
                $attachment = new Attachment;
                $attachment->module = $dispatcher->getModuleName();
                $attachment->userId = $auth->getId();
                $attachment->nickname = $auth->getName();
                $attachment->dir = $dir;
                $attachment->path = $path;
                $attachment->thumbPath = $path;
                $attachment->name = $name;
                $attachment->size = $size;
                $attachment->type = $type;
                $attachment->isImage = $isImage ? 1 : 0;
                $attachment->width = $width;
                $attachment->height = $height;
                
                if ($attachment->save())
                    return $attachment;
                else
                    return self::ERR_SAVEFAILED;
            } else {
                return self::ERR_SAVEFAILED;
            }
        }

        return self::ERR_NOFILE;
    }

    public static function getName($ext = NULL)
    {
        $name = time() . uniqid();
        return $ext ? $name . '.' . $ext : $name;
    }

    public static function getExt($name)
    {
        $ext = NULL;
        if (strrpos($name, '.') !== FALSE)
            $ext = substr($name, strrpos($name, '.') + 1);

        return strtolower($ext);
    }
}