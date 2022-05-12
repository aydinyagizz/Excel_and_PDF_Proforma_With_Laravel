@extends('layouts.adminLayout')

@section('title')
@endsection

@section('css')
@endsection

@section('content')

    <div class="box box-primary" style="position: relative; left: 0px; top: 0px;">
        <div class="box-header ui-sortable-handle">
            <section class="content-header">
                <i class="ion ion-clipboard fa-2x"></i>
                <h3 class="box-title"> Kullanıcı Düzenle</h3>

                <ol class="breadcrumb">
                    <li><a href="{{route('admin.index')}}"></i> Anasayfa</a></li>
                    <li><a href="{{route('admin.userList')}}"></i> Kullanıcılar</a></li>
                    <li class="active">Fatura Düzenle</li>
                </ol>

            </section>


        </div>
        <div class="box-body">
            <form action="{{ route('admin.userUpdate') }}" method="POST">
                @csrf
                @if($errors->count() > 0)
                    <div class="form-group alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                {{ $error }}

                            @endforeach
                        </ul>
                    </div>

                @endif
                <input type="hidden" name="id" value="{{$user->id}}">
                <div class="box-footer clearfix no-border form-group">
                    <div>
                        <label class="text" for="fullName">Ad Soyad</label>
                        <input type="text" name="fullName" class="form-control" placeholder="Ad Soyad" required value="{{$user->name}}">
                    </div>

                    <div>
                        <label class="text" for="email">Email</label>
                        <input type="text" name="email" class="form-control" disabled placeholder="" value="{{$user->email}}" >
                    </div>

                    <div class="form-group has-feedback">
                        <label class="text" for="role">Rol</label>
                        <select class="form-control" name="role" id="role">

                            @foreach($roles as $role)
                                <option value="{{$role->name}}" {{$user->hasRole($role->name) ? 'selected' : ''}}>{{$role->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="text" for="iskontoKisiti">İskonto kısıtı</label>
                        <input type="text" name="iskontoKisiti" class="form-control" placeholder="İskonto kısıtı" required value="{{$user->iskontoKisiti}}">
                    </div>


                    <br>
                    <button type="submit" class="btn btn-default pull-right"><i class="fa fa-pencil"></i> Düzenle</button>
                </div>
            </form>
        </div>
    </div>


@endsection

@section('js')
@endsection
