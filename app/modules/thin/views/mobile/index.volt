<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="keywords" content="vivo, Xshot, Xplay, Xplay3S, X3S, X3, HIFI">
    <meta name="description" content="">
    <title>我要和X5Max拼薄 - vivo智能手机</title>
    <link rel="stylesheet" type="text/css" href="{{ static_url('/common/css/nprogress.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ static_url('/common/dialog/css/ui-dialog.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ static_url('css/mobile.css') }}">
    <script type="text/javascript">var ISMOBILE = {{ isMobile ? 1 : 0 }}, ISWEIXIN = {{ isWeixin ? 1 : 0 }};</script>
    <script type="text/javascript" src="{{ static_url('/common/js/zepto.min.js') }}"></script>
    <script type="text/javascript" src="{{ static_url('/common/js/zepto.pjax.min.js') }}"></script>
    <script type="text/javascript" src="{{ static_url('/common/js/nprogress.min.js') }}"></script>
    {{ assets.outputJs() }}
    <script type="text/javascript" src="{{ static_url('js/mobile.js') }}"></script>
</head>
<body>
	<div class="pageloading"></div>
    <div class="container table">
        <div class="table-cell">
        	<a href="{{ url('/thin/') }}" data-pjax>
            	<img src="{{ static_url('img/logo.png') }}" class="logo">
			</a>
            <div id="pjax-container">{{ content() }}</div>
        </div>
    </div>

    {{ weixin_share([
        'title': '我要和X5Max拼薄',
        'description': '#我要和X5Max拼薄# ',
        'picUrl': static_url('img/400x400.png'),
        'url': url('/thin/')
    ]) }}
</body>
</html>