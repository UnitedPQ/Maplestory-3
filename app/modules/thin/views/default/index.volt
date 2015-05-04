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
    <link rel="stylesheet" type="text/css" href="{{ static_url('css/main.css') }}">
    <script type="text/javascript">var ISMOBILE = {{ isMobile ? 1 : 0 }}, ISWEIXIN = {{ isWeixin ? 1 : 0 }};</script>
    <script type="text/javascript" src="{{ static_url('/common/js/jquery-1.11.1.min.js') }}"></script>
    <script type="text/javascript" src="{{ static_url('/common/js/jquery.pjax.min.js') }}"></script>
    <script type="text/javascript" src="{{ static_url('/common/js/nprogress.min.js') }}"></script>
    <script type="text/javascript" src="{{ static_url('/common/dialog/dist/dialog-min.js') }}"></script>
    {{ assets.outputJs() }}
    <script type="text/javascript" src="{{ static_url('js/main.js') }}"></script>
</head>
<body>
    <div class="container">
        <table class="wrapper">
            <tr>
                <td>
                    <div id="pjax-container">{{ content() }}</div>

                    <a href="{{ url('/thin/') }}" data-pjax><img src="{{ static_url('img/logo.png') }}" class="logo"></a>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>