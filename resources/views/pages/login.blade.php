<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin Girişi</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{asset("assets/bower_components/bootstrap/dist/css/bootstrap.min.css")}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset("assets/bower_components/font-awesome/css/font-awesome.min.css")}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{asset("assets/bower_components/Ionicons/css/ionicons.min.css")}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset("assets/dist/css/AdminLTE.min.css")}}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{asset("assets/plugins/iCheck/square/blue.css")}}">

    <link rel="stylesheet" href="{{asset("assets/dist/css/sweetalert2.css")}}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <b>Admin</b> Paneli
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Giriş yapınız</p>

        <form action="{{'login'}}" method="POST" id="loginForm">
            @csrf

            @if($errors->count() > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                           Giriş başarısız. Bilgileri kontrol ediniz.
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="form-group has-feedback" for="email">
                <input type="email" class="form-control" placeholder="Email" name="email" id="email" value="{{old('email')}}">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback" for="password">
                <input type="password" class="form-control" placeholder="Şifre" name="password" id="password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-8">
                    <div class="checkbox icheck">
                        <label>
{{--                            <input type="checkbox"> Beni Hatırla--}}
                        </label>
                    </div>
                </div>

                <!-- /.col -->
                <div class="col-xs-4">
                    <button id="btnLogin" type="button" class="btn btn-primary btn-block btn-flat">Giriş yap</button>
                </div>
                <!-- /.col -->
            </div>

{{--            <div>--}}
{{--                <p align="center">Hesabınız yok mu? <a href="{{route('register')}}">Kayıt Ol.</a></p>--}}
{{--            </div>--}}
        </form>


        <!-- /.social-auth-links -->

    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="{{asset("assets/bower_components/jquery/dist/jquery.min.js")}}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{asset("asstes/bower_components/bootstrap/dist/js/bootstrap.min.js")}}"></script>
<!-- iCheck -->
<script src="{{asset("assets/plugins/iCheck/icheck.min.js")}}"></script>


<script src="{{asset("assets/dist/js/sweetalert2.js")}}"></script>
<script src="{{asset("assets/dist/js/sweetalert2.all.js")}}"></script>

<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' /* optional */
        });
    });

    $('#btnLogin').click(function (){
        let email = document.querySelector('#email').value;
        let password = document.querySelector('#password').value;

        if (email.trim() == '') {
            Swal.fire({
                icon: 'info',
                title: 'Uyarı',
                text: 'Email adresinizi giriniz',
                confirmButtonText: 'Tamam'
            })

        } else if (!emailControl(email)) {
            Swal.fire({
                icon: 'info',
                title: 'Uyarı',
                text: 'Geçerli bir email adresi giriniz.',
                confirmButtonText: 'Tamam'
            })

        } else if (password.trim() == '') {
            Swal.fire({
                icon: 'info',
                title: 'Uyarı',
                text: 'Parolayı giriniz.',
                confirmButtonText: 'Tamam'
            })

        } else {
            $('#loginForm').submit();
        }
    });

    //email kontrolünü yapıyor.
    function emailControl(email) {
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        return regex.test(email);
    }
</script>
</body>
</html>
