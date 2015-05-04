<?php

if ( ! function_exists("fastcgi_finish_request")) {
    function fastcgi_finish_request() { return TRUE; }
}

function array_get(array $arr, $key, $default = NULL)
{
    if (isset($arr[$key]))
        return $arr[$key];
    else
        return $default;
}

function format_json(array $data = array()) {
    if ( ! $data) return '';

    $data = preg_replace('/\\\u([0-9a-f]{4})/ie', "iconv('UCS-2BE', 'UTF-8', pack('H4', '\\1'))", json_encode($data));
    if (preg_match('/^\[.*\]$/', $data)) {
        $data = substr($data, 1, strlen($data)-2);
    }
    return $data;
}

function base62encode($data) {
    $outstring = '';
    $l = strlen($data);
    for ($i = 0; $i < $l; $i += 8) {
        $chunk = substr($data, $i, 8);
        $outlen = ceil((strlen($chunk) * 8)/6);
        $x = bin2hex($chunk);
        $w = gmp_strval(gmp_init(ltrim($x, '0'), 16), 62);
        $pad = str_pad($w, $outlen, '0', STR_PAD_LEFT);
        $outstring .= $pad;
    }
    return $outstring;
}

function base62decode($data) {
    $outstring = '';
    $l = strlen($data);
    for ($i = 0; $i < $l; $i += 11) {
        $chunk = substr($data, $i, 11);
        $outlen = floor((strlen($chunk) * 6)/8);
        $y = gmp_strval(gmp_init(ltrim($chunk, '0'), 62), 16);
        $pad = str_pad($y, $outlen * 2, '0', STR_PAD_LEFT);
        $outstring .= pack('H*', $pad);
    }
    return $outstring;
}