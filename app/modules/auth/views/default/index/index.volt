<!doctype html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="language" content="en" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="keywords" content="vivo, Xshot, Xplay, Xplay3S, X3S, X3, HIFI">
    <meta name="description" content="">
    <title>登录 - vivo智能手机</title>
    <link rel="stylesheet" type="text/css" href="{{ static_url('css/site.css') }}">
    {% if clientId %}
    <script src="http://js.t.sinajs.cn/t4/enterprise/js/public/appframe/appClient.js" type="text/javascript"></script>
    <script type="text/javascript">
    function authLoad(){
        App.AuthDialog.show({
            client_id : '{{ subAppKey }}',    //必选，填入框架通过get方式传递的sub_appkey参数
            redirect_uri : '{{ redirectUri }}',     
            //必选，授权回调地址，必须以http://e.weibo.com开头，类似http://e.weibo.com/1717871843/app_738247391
            //或者http://e.weibo.com/thirdapp/app?appkey=738247391，不同企业应用的前台url是不固定的，需要用uid拼装
            height: 120,    //可选，默认距顶端120px
            display: 'apponweibo'  //必选，移动端H5授权则应为display: 'mobile'
        });
    }
    </script>
    {% endif %}
</head>
<body{% if clientId %} onload="authLoad();"{% endif %}>
    {% if not clientId %}<strong>请先到应用广场安装此应用后再访问！</strong>{% endif %}
</body>
</html>