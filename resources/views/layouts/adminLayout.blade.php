<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield("title")</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="{{url("assets/bower_components/bootstrap/dist/css/bootstrap.min.css")}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{url("assets/bower_components/font-awesome/css/font-awesome.min.css")}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{url("assets/bower_components/Ionicons/css/ionicons.min.css")}}">

    <link rel="stylesheet"
          href="{{url("assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css")}}">
    <link rel="stylesheet" href="{{url("assets/bower_components/select2/dist/css/select2.min.css")}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{url("assets/dist/css/AdminLTE.min.css")}}">
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
          page. However, you can choose any other skin. Make sure you
          apply the skin class to the body tag so the changes take effect. -->
    <link rel="stylesheet" href="{{url("assets/dist/css/skins/skin-blue.min.css")}}">

    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

    <script src="https://unpkg.com/bootstrap-table@1.20.0/dist/bootstrap-table.min.js"></script>
    <script src="https://unpkg.com/bootstrap-table@1.20.0/dist/bootstrap-table-locale-all.min.js"></script>



{{--    <link rel="stylesheet" href="{{asset("assets/bower_components/select2/dist/css/select2.min.css")}}">--}}



    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>

@yield('css')

    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <script src='http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js'></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <!-- Main Header -->
    <header class="main-header">

        <!-- Logo -->
        <a href="{{url("/")}}" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>DGH</b></span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>Yönetim</b> Paneli</span>
        </a>

        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- Messages: style can be found in dropdown.less-->

                    <!-- /.messages-menu -->
                @php
                    if(Auth::check()){
                        $user = Auth::user();
                    }

                @endphp
                <!-- User Account Menu -->
                    <li class="dropdown user user-menu">
                        <!-- Menu Toggle Button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <!-- The user image in the navbar-->
                            <img src="{{asset("assets/dist/img/user.png")}}" class="user-image" alt="User Image">
                            <!-- hidden-xs hides the username on small devices so only the image appears. -->
                            <span class="hidden-xs">{{$user->name}}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- The user image in the menu -->
                            <li class="user-header">
                                <img src="{{asset("assets/dist/img/user.png")}}" class="img-circle" alt="User Image">

                                <p>
                                    {{$user->name}} -  {{$user->roles[0]->name}}
                                    <small>Tarih: {{date('d/m/Y')}}</small>
                                </p>
                            </li>
                            <!-- Menu Body -->

                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    @role('Admin')
                                    <a href="{{route('register')}}" class="btn btn-default btn-flat">Kullanıcı Ekle</a>
                                    @endrole
                                </div>
                                <div class="pull-right" align="right">
                                    <a href="{{route('logout')}}" class="btn btn-default btn-flat">Çıkış yap</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <!-- Control Sidebar Toggle Button -->

                </ul>
            </div>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->


@include("layouts.adminMenu")

<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->


        <!-- Main content -->
        <section class="content container-fluid">
            <div class="box">
                <!--------------------------
                  | Your Page Content Here |
                  -------------------------->


                @yield('content')


            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Main Footer -->
    <footer class="main-footer">
        <!-- To the right -->
        <div class="pull-right hidden-xs">
            {{--            Anything you want--}}
        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; {{date('Y')}} <a target="_blank" href="https://dghyazilim.com/">DGH</a></strong>
    </footer>

    <!-- Control Sidebar -->

    <!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
    immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

{{--<script src="http://code.jquery.com/jquery-1.11.0.min.js%22%3E"></script>--}}

<!-- jQuery 3 -->
<script src="{{url("assets/bower_components/jquery/dist/jquery.min.js")}}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{url("assets/bower_components/bootstrap/dist/js/bootstrap.min.js")}}"></script>
<script src="{{url("assets/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js")}}"></script>


<script src="{{url("assets/bower_components/select2/dist/js/select2.full.min.js")}}"></script>
<script src="{{url("assets/bower_components/moment/min/moment.min.js")}}"></script>


<script src="{{url("assets/bower_components/datatables.net/js/jquery.dataTables.min.js")}}"></script>
<script src="{{url("assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js")}}"></script>
<script src="{{url("assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js")}}"></script>
<script src="{{url("assets/bower_components/fastclick/lib/fastclick.js")}}"></script>


<script src="{{url("assets/plugins/iCheck/icheck.min.js")}}"></script>


<script src="{{url("assets/dist/js/demo.js")}}"></script>

<!-- AdminLTE App -->
<script src="{{url("assets/dist/js/adminlte.min.js")}}"></script>

<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. -->

@yield('js')

</body>
</html>
