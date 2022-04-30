@extends('layouts.adminLayout')

@section('title')
@endsection

@section('css')
@endsection

@section('content')


    <div class="box box-primary" style="position: relative; left: 0px; top: 0px;">
        <div class="box-header ui-sortable-handle">
            <i class="ion ion-clipboard"></i>

            <h3 class="box-title">Faturalar</h3>
        </div>
        <div class="box-body">

{{--{{dd($teklif[0]->miktar)}}--}}

            <ul class="todo-list ui-sortable">
                <li class="" style="background-color: white !important;">
                    <table class="table">

                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Müşteri</th>
                                <th>Fatura No</th>
                                <th>Ekleme tarihi</th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $say=1;
                            @endphp
                            @foreach($fatura as $faturaItem)

                            <tr>
                                <td>{{$say}}</td>
                                <td> {{$faturaItem->musteriAdSoyad}} </td>
                                <td> {{$faturaItem->faturaNo}} </td>
                                <td> {{($faturaItem->created_at)->format('d/m/Y')}} </td>
                                <td><a href="{{url('faturaEdit/'.$faturaItem->id)}}"><i class="fa fa-edit"></i></a> </td>
                                <td><a href="{{url('faturaDelete/'.$faturaItem->id)}}"><i class="fa fa-trash-o"></i> </a></td>
                                <td><a href="{{url('teklifPdf/'.$faturaItem->id)}}"><i class="fa fa-eye"></i> </a></td>
                            </tr>
                            @php
                                $say++;
                            @endphp
                            @endforeach
                        </tbody>
                    </table>
                    <div class="text-center">
                        {!! $fatura->links() !!}
                    </div>
                </li>
            </ul>
        </div>
    </div>



@endsection

@section('js')
@endsection
