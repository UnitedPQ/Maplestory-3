<?php

namespace App\Helpers;

use Wechat\HttpRequest;

class Weixin extends HelperBase
{
    public static function httpGet($host, $url, $parameters = array(), $ssl = TRUE) {
        $port = $ssl ? 443 : 80;
        $request = new HttpRequest($host, $url, $port);
        $parameters = http_build_query($parameters);
        $request->setGetData($parameters);
        $request->execute();
        $result = $request->getResponseText();
        $request->close();
        if ($result) {
            return json_decode($result, TRUE);
        } else {
            return FALSE;
        }
    }

    public static function accessToken() {
        $appId = '1';
        $appKey = 'bD2VehhHiPb7gjw6MV49rUnc';
        $timestamp = TIMESTAMP;

        $apiUrl = 'http://service.wx.vivo.com.cn/api/token/get?timestamp=%s&id=%s&key=%s';
        $apiUrl = sprintf($apiUrl, $timestamp, $appId, md5($appId . $appKey . $timestamp));

        $response = file_get_contents($apiUrl);
        $data = json_decode($response, TRUE);

        if(empty($data['error']))
            return $data['info'];
        else
            return NULL;
    }

    public static function ticket() {
        $ticket = self::getShared('dataBag')->get('ticket', NULL, 'core');

        if (empty($ticket) || ($ticket['expire_at'] <= TIMESTAMP)) {
            $accessToken = self::accessToken();
            $parameters = array(
                'access_token' => $accessToken,
                'type' => 'jsapi'
            );

            $res = self::httpGet('api.weixin.qq.com', '/cgi-bin/ticket/getticket', $parameters);
            if ($res && empty($res['errcode'])) {
                $ticket = array(
                    'ticket' => $res['ticket'],
                    'expire_at' => TIMESTAMP + $res['expires_in'],
                );
                self::getShared('dataBag')->set('ticket', $ticket, 'core');
            }
        }

        return $ticket['ticket'];
    }

    public static function currentUrl() {
        $pageURL = 'http';
        if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on")
            $pageURL .= "s";
        $pageURL .= "://".$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];
        return $pageURL;
    }

    public static function sign()
    {
        $ticket = self::ticket();
        $timestamp = TIMESTAMP;
        $nonceStr = uniqid().uniqid();
        $url = self::currentUrl();

        $sortStr = "jsapi_ticket={$ticket}&noncestr={$nonceStr}&timestamp={$timestamp}&url={$url}";
        $signature = sha1($sortStr);

        return array(
            'nonceStr' => $nonceStr,
            'timestamp' => $timestamp,
            'signature' => $signature,
        );
    }

    public static function shareCode($options = array())
    {
        $appId = self::getShared('config')->weixin->appId;
        $moduleName = self::getShared('dispatcher')->getModuleName();
        $reportUrl = self::getShared('url')->get('/share.json');

        $title = array_get($options, 'title');
        $description = array_get($options, 'description');
        $url = array_get($options, 'url', self::getShared('dispatcher')->getCurrentURI());
        $picUrl = array_get($options, 'picUrl');
        if (empty($picUrl)) {
            $picUrl = Uri::staticUrl("/{$moduleName}/img/400.jpg");
        }

        $sign = self::sign();

        $script = <<<EOD
window.appId = '{$appId}';
window.moduleName = '{$moduleName}';
window.shareData = {
    'title': '{$title}',
    'description': '{$description}',
    'url': '{$url}',
    'picUrl': '{$picUrl}'
};

function report(link, type) {
    $.ajax({
        url: '{$reportUrl}',
        type: 'POST',
        dataType: 'json',
        data: {link: link, type: type, module: window.moduleName}
    });
    return true;
};

var ua = navigator.userAgent.toLowerCase();
var WXversion = ua.match(/micromessenger/) ? ua.match(/micromessenger\/([\d.]+)/)[1] : null;

if (WXversion >= '6.0.2') {
    wx.config({
        debug: false,
        appId: '{$appId}',
        timestamp: '{$sign["timestamp"]}',
        nonceStr: '{$sign["nonceStr"]}',
        signature: '{$sign["signature"]}',
        jsApiList: ["onMenuShareTimeline","onMenuShareAppMessage"]
    });

    function refreshShareData() {
        wx.ready(function(){
            wx.onMenuShareTimeline({
                title: window.shareData.title,
                link: window.shareData.url,
                imgUrl: window.shareData.picUrl,
                success: function () { 
                    report(window.shareData.url, 'timeline');
                },
                cancel: function () {}
            });

            wx.onMenuShareAppMessage({
                title: window.shareData.title,
                desc: window.shareData.description,
                link: window.shareData.url,
                imgUrl: window.shareData.picUrl,
                type: '',
                dataUrl: '',
                success: function () { 
                    report(window.shareData.url, 'appmessage');
                },
                cancel: function () {}
            });
        });
    };
    refreshShareData();
} else {
    (function() {
        function onBridgeReady() {
            WeixinJSBridge.call('hideToolbar');
            WeixinJSBridge.call('showOptionMenu');

            WeixinJSBridge.on('menu:share:timeline', function(argv){
                WeixinJSBridge.invoke('shareTimeline',{
                    "img_url"    : window.shareData.picUrl,
                    "img_width"  : "400",
                    "img_height" : "400",
                    "link"       : window.shareData.url,
                    "desc"       : window.shareData.description,
                    "title"      : window.shareData.title
                }, function(res){
                    report(window.shareData.url, 'timeline');
                });
            });

            WeixinJSBridge.on('menu:share:appmessage', function(argv){
                WeixinJSBridge.invoke('sendAppMessage',{
                    "appid"      : appId,
                    "img_url"    : window.shareData.picUrl,
                    "img_width"  : "400",
                    "img_height" : "400",
                    "link"       : window.shareData.url,
                    "desc"       : window.shareData.description,
                    "title"      : window.shareData.title
                }, function(res){
                    report(window.shareData.url, 'appmessage');
                });
            });

            WeixinJSBridge.on('menu:share:weibo', function(argv){
                WeixinJSBridge.invoke('shareWeibo',{
                    "content" : window.shareData.description + window.shareData.url,
                    "url"     : window.shareData.url
                }, function(res){
                    report(window.shareData.url, 'weibo');
                });
            });

            WeixinJSBridge.on('menu:share:facebook', function(argv){
                WeixinJSBridge.invoke('shareFB',{
                      "img_url"    : window.shareData.picUrl,
                      "img_width"  : "640",
                      "img_height" : "640",
                      "link"       : window.shareData.url,
                      "desc"       : window.shareData.description,
                      "title"      : window.shareData.title
                }, function(res) {
                    report(window.shareData.url, 'facebook');
                });
            });

            WeixinJSBridge.on('menu:general:share', function(argv){
                argv.generalShare({
                    "appid"      : appId,
                    "img_url"    : window.shareData.picUrl,
                    "img_width"  : "640",
                    "img_height" : "640",
                    "link"       : window.shareData.url,
                    "desc"       : window.shareData.description,
                    "title"      : window.shareData.title
                }, function(res){
                    report(window.shareData.url, argv.shareTo);
                });
            });
        };

        document.addEventListener('WeixinJSBridgeReady', onBridgeReady);
    })();
}
EOD;

        $script = preg_replace("/([^\w])[\s]+/", "\\1", $script);
        $script = preg_replace("/[\s]+([^\w])/", "\\1", $script);

        $script = <<<EOD
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script type="text/javascript">$script</script>
EOD;
        return $script;
    }
}