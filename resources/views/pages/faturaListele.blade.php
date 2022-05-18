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

                    <div align="right">
                        <input class="search" id="myInput" type="text" placeholder="Arama..">
                        <br>
                    </div>

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

                        @role('Admin')
                        <tbody id="myTable">
                        @php
                            $say = ($fatura->currentpage()-1)* $fatura->perpage() + 1;
                        @endphp

                        @foreach($fatura as $faturaItem)

                            <tr>
                                <td><b>{{$say++}}</b></td>
                                <td> {{$faturaItem->musteriAdSoyad}} </td>
                                <td> {{$faturaItem->faturaNo}} </td>
                                <td> {{($faturaItem->created_at)->format('d/m/Y')}} </td>
                                <td><a href="{{url('faturaEdit/'.$faturaItem->id)}}"><i class="fa fa-edit"></i></a></td>
                                <td><a href="{{url('faturaDelete/'.$faturaItem->id)}}"><i class="fa fa-trash-o"></i>
                                    </a></td>
                                <td><a href="{{url('teklifPdf/'.$faturaItem->id)}}"><i class="fa fa-eye"></i> </a></td>
                            </tr>

                        @endforeach
                        </tbody>
@endrole
                        @role('Kullanıcı')
                        <tbody id="myTable">

                        @php
                            $say = ($kullaniciFaturalari->currentpage()-1)* $kullaniciFaturalari->perpage() + 1;
                        @endphp
                        @foreach($kullaniciFaturalari as $kullaniciFaturaItem)


                            <tr>
                                <td><b>{{$say++}}</b></td>
                                <td> {{$kullaniciFaturaItem->musteriAdSoyad}} </td>
                                <td> {{$kullaniciFaturaItem->faturaNo}} </td>
{{--                                <td> {{($kullaniciFaturaItem->created_at)->format('d/m/Y')}} </td>--}}
                                <td> {{ Carbon\Carbon::parse($kullaniciFaturaItem->created_at)->format('d/m/Y') }} </td>
                                <td><a href="{{url('faturaEdit/'.$kullaniciFaturaItem->id)}}"><i class="fa fa-edit"></i></a></td>
                                <td><a href="{{url('faturaDelete/'.$kullaniciFaturaItem->id)}}"><i class="fa fa-trash-o"></i>
                                    </a></td>
                                <td><a href="{{url('teklifPdf/'.$kullaniciFaturaItem->id)}}"><i class="fa fa-eye"></i> </a></td>
                            </tr>

                        @endforeach
                        @endrole
                        </tbody>
                    </table>
                    @role('Admin')
                    <div class="text-center">
                        {!! $fatura->links() !!}
                    </div>
                    @endrole

                    @role('Kullanıcı')
                    <div class="text-center">
                        {!! $kullaniciFaturalari->links() !!}
                    </div>
                    @endrole
                </li>
            </ul>
        </div>
    </div>



@endsection

@section('js')
    <script>
        $(document).ready(function(){
            $("#myInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                value = value.trim();
                $("#myTable tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                    console.log(value);
                });
            });
        });
    </script>
@endsection
