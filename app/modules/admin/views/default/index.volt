<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>vivo活动管理 | Dashboard</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link href="//cdn.staticfile.org/twitter-bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="//cdn.staticfile.org/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="//cdn.staticfile.org/ionicons/1.5.2/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <link href="{{ static_url('css/AdminLTE.css') }}" rel="stylesheet" type="text/css" />
    </head>
    <body class="skin-blue">
        {{ partial('common/nav') }}

        <div class="wrapper row-offcanvas row-offcanvas-left">
            {{ partial('common/sidebar') }}
            {{ content() }}
        </div>

        <script src="//cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
        <script src="//cdn.staticfile.org/twitter-bootstrap/3.2.0/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="//cdn.staticfile.org/iCheck/1.0.1/icheck.min.js" type="text/javascript"></script>
        <script src="//cdn.staticfile.org/jQuery-slimScroll/1.3.1/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="//cdn.staticfile.org/pace/1.0.1/pace.min.js" type="text/javascript"></script>
        <script src="{{ static_url('js/AdminLTE/app.js') }}" type="text/javascript"></script>
    </body>
</html>