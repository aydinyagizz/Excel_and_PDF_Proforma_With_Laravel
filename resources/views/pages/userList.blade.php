@extends('layouts.adminLayout')

@section('title')
@endsection

@section('css')
@endsection

@section('content')


    <div class="box box-primary" style="position: relative; left: 0px; top: 0px;">
        <div class="box-header ui-sortable-handle">
            <i class="ion ion-clipboard"></i>

            <h3 class="box-title">Kullanıcılar</h3>
        </div>
        <div class="box-body">

{{--{{dd($teklif[0]->miktar)}}--}}

            <ul class="todo-list ui-sortable">
                <li class="" style="background-color: white !important;">
                    <table class="table">
                        @if($errors->count() > 0)
                            <div class="form-group alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        {{ $error }}

                                    @endforeach
                                </ul>
                            </div>

                        @endif

                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Adı</th>
                                <th>Email</th>
                                <th>Rol</th>
                                <th></th>


                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $say=1;


                            @endphp
                            @foreach($user as $userItem)

                            <tr>
                                <td>{{$say}}</td>
                                <td> {{$userItem->name}} </td>
                                <td> {{$userItem->email}} </td>
                                <td>
                                    @foreach($userItem->roles as $role)
                                        {{$role->name}}
                                    @endforeach
                                </td>
                                <td><a href="{{url('userEdit/'.$userItem->id)}}"><i class="fa fa-edit"></i></a> </td>
                                <td><a href="{{url('userDelete/'.$userItem->id)}}"><i class="fa fa-trash-o"></i> </a></td>

                            </tr>
                            @php
                                $say++;
                            @endphp
                            @endforeach
                        </tbody>
                    </table>
                    <div class="text-center">
                        {!! $user->links() !!}
                    </div>
                </li>
            </ul>
        </div>
    </div>



@endsection

@section('js')
@endsection
