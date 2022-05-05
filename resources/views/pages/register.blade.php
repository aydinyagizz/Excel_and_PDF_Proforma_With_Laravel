
@extends('layouts.adminLayout')

@section('title')
@endsection

@section('css')
@endsection

@section('content')
    @php
        if(Auth::check()){
$user = Auth::user();
}

    @endphp

    @role('Admin')
    <section class="content-header">
        <ol class="breadcrumb">
            <button class="btn btn-primary"><a href="{{url('userList')}}" style="color: white;"></i> Kullanıcıları Listele</a></button>

        </ol>

    </section>
@endrole
<div class="register-box">
    <div class="register-logo">
        <p> Yeni Kayıt Oluştur</p>
    </div>



    <div class="register-box-body">
{{--        <p class="login-box-msg">Yeni kayıt oluştur</p>--}}

        <form action="{{route('register')}}" method="POST">
            @csrf
            @if($errors->count() > 0)
                <div class="form-group alert alert-danger">
                    <ul>
                    @foreach ($errors->all() as $error)
                        {{ $error }}
                    @endforeach
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </ul>
                </div>

            @endif


            <div class="form-group has-feedback">
                <input type="text" class="form-control" placeholder="Ad Soyad" name="fullName" required>
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="email" class="form-control" placeholder="Email" name="email" required>
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <select class="form-control" name="role" id="role">
                    @foreach($roles as $role)
                        <option value="{{$role->name}}">{{$role->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control" placeholder="Şifre" name="password" required>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control" placeholder="Şifre Tekrar" name="confirmPassword" required>
                <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat" >Kayıt Ol</button>
                </div>
            </div>

{{--            <div>--}}
{{--                <p align="center">Hesabınız var mı? <a href="{{url('login')}}">Giriş yap.</a></p>--}}
{{--            </div>--}}
        </form>



    </div>
@endsection

@section('js')

    <script>
        $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%'
            });
        });
    </script>
@endsection


