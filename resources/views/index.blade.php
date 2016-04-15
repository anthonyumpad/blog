<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{{ $page_title or "Blog" }}</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="{{ asset("/bower_components/admin-lte/bootstrap/css/bootstrap.min.css") }}" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="//code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="{{ asset("/bower_components/admin-lte/dist/css/AdminLTE.min.css")}}" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
          page. However, you can choose any other skin. Make sure you
          apply the skin class to the body tag so the changes take effect.
    -->
    <link href="{{ asset('/css/blog-admin.css') }}" rel="stylesheet">
    <link href="{{ asset("/bower_components/admin-lte/dist/css/skins/skin-blue.min.css")}}" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <link href="{{ asset("/bower_components/admin-lte/plugins/iCheck/square/blue.css")}}" rel="stylesheet" type="text/css" />
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="//oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="//oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>
<body class="login-page">
<div class="login-box">

    <div class="login-box-body">
        <p class="login-box-msg">Sign in to Blog Dashboard</p>
        @if(! empty(session('flash_message')))
            <div class="alert alert-{{ session('flash_message')['status'] }}">
                <div class="layoutContainer">
                    <div class="container">
                        @if(isset(session('flash_message')['code']))
                            {{ session('flash_message')['code'] }}
                        @else
                            {{ session('flash_message')['message'] }}
                        @endif
                        {{-- <b>{{ session('flash_message')['message']}}</b> {{session('flash_message')['error_fields']}} --}}</div>
                </div>
            </div>
        @endif

        @if (Session::has('success-message'))
            <div class="centered text-center">
                <p class="text-green">{{ Session::get('success-message') }}</p>
            </div>
        @endif
        <form action="/admin/authenticate" method="post">
            {{ csrf_field() }}
            <div class="form-group has-feedback">
                <input type="email" name="email" class="form-control" placeholder="Email" value="{{ Input::old('email') }}" required>
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" name="password" class="form-control" placeholder="Password" required>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <!-- /.col -->
                <div class="col-xs-12">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                </div>
                <!-- /.col -->
            </div>
        </form>
    </div><!-- /.login-box-body -->
</div><!-- /.login-box -->
<p class="text-center" style="color:#808588;font-size:12px;">Blog admin v1</p>
<!-- REQUIRED JS SCRIPTS -->
<!-- jQuery 2.1.3 -->
<script src="{{ asset ("/bower_components/admin-lte/plugins/jQuery/jQuery-2.1.4.min.js") }}"></script>
<!-- Bootstrap 3.3.2 JS -->
<script src="{{ asset ("/bower_components/admin-lte/bootstrap/js/bootstrap.min.js") }}" type="text/javascript"></script>
<!-- AdminLTE App -->
<script src="{{ asset ("/bower_components/admin-lte/dist/js/app.min.js") }}" type="text/javascript"></script>
<!-- iCheck -->
<script src="{{ asset("/bower_components/admin-lte/plugins/iCheck/icheck.min.js") }}" type="text/javascript"></script>
<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
    });

    var forgotPassword = function() {
        $('#loginForm').attr('action', "{{url('/admin/forgot-password')}}");
        $('#loginForm').submit();
    };
</script>
</body>
</html>
