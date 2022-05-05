@extends('layouts.adminLayout')

@section('title')
@endsection

@section('css')
@endsection

@section('content')


    <div class="box box-primary" style="position: relative; left: 0px; top: 0px;">
        <div class="box-header ui-sortable-handle">
            {{--            <i class="ion ion-clipboard"></i>--}}

            {{--            <h3 class="box-title">Teklif Ekle</h3>--}}
            {{--            <ol class="breadcrumb">--}}
            {{--                <li><a href="{{route('admin.index')}}"> Anasayfa</a></li>--}}
            {{--                <li><a href="{{route('admin.index')}}">Fatura Ekle</li>--}}
            {{--                <li class="active">Teklif Ekle</li>--}}
            {{--            </ol>--}}


            <section class="content-header">
                <i class="ion ion-clipboard fa-2x"></i>
                <h3 class="box-title"> Ürün Ekle</h3>

                <ol class="breadcrumb">
                    <li><a href="{{route('admin.index')}}"></i> Anasayfa</a></li>
                    <li class="active">Ürün Ekle</li>
                </ol>

            </section>

        </div>
        <div class="box-body">
            {{--            <form action="{{route('admin.teklifEkle')}}" method="POST">--}}

            <form action="{{ route('admin.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <label type="text">Excelden ürün ekle</label>
                <input type="file" name="import_file"><br>
                <input type="submit" class="btn btn-primary" value="Değişiklikleri içe aktar">
                <br>
            </form>
            <form action="{{url('urunEkle')}}" method="POST">
                @csrf

                <div class="box-footer clearfix no-border form-group">
                    <div class="row">

                        <div class="col-md-12">
                            <label class="text" for="siparisOzellik">Sipariş ve özellikler</label>
                            <input type="text" name="siparisOzellik" class="form-control"
                                   placeholder="Sipariş ve özellikler" required>
                        </div>


                        <div class="col-md-4">
                            <label class="text" for="miktar">Miktar</label>
                            <input type="number" min="0" name="miktar" class="form-control" placeholder="Miktar"
                                   required>
                        </div>

                        <div class="col-md-4">
                            <label class="text" for="birim">Birim</label>
                            <input type="text" name="birim" class="form-control" placeholder="Birim" required>
                        </div>

                        <div class="col-md-4">
                            <label class="text" for="malzemeFiyati">Malzeme Fiyatı</label>
                            <input type="number" min="0" name="malzemeFiyati" class="form-control"
                                   placeholder="Malzeme Fiyatı"
                                   required>
                        </div>

                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Ekle</button>
                </div>
            </form>


        </div>

        {{--{{dd($teklif[0]->miktar)}}--}}

        <ul class="todo-list ui-sortable">

            <li class="" style="background-color: white !important;">

                <table class="table">

                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Sipariş Özellikleri</th>
                        <th>Miktar</th>
                        <th>Birim</th>
                        <th>Malzeme Fiyatı</th>
                        <th>Ürün Tutar</th>

                        <th></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>

                    @php
                    $say = ($urun->currentpage()-1)* $urun->perpage() + 1;
                    @endphp
                    @foreach($urun as $urunItem)
                        <tr>
                            <td><b>{{$say++}}</b></td>
                            <td> {{$urunItem->siparisOzellik}} </td>
                            <td> {{$urunItem->miktar}} </td>
                            <td> {{$urunItem->birim}} </td>
                            <td> {{$urunItem->malzemeFiyati}} </td>
                            <td> {{number_format((($urunItem->miktar)*($urunItem->malzemeFiyati)),2)}} </td>
{{--                            <td> {{($urunItem->created_at)->format('d/m/Y')}} </td>--}}
                            {{--                            <td><a href="teklifEdit/{{$teklif->id}}"><i class="fa fa-edit"></i></a> </td>--}}
                            <td><a href="{{url('urunEdit/'.$urunItem->id)}}"><i class="fa fa-edit"></i></a></td>
                            <td><a href="{{url('urunDelete/'.$urunItem->id)}}"><i class="fa fa-trash-o"></i> </a>
                            </td>
                        </tr>


                    @endforeach
                    </tbody>
                </table>

            </li>
        </ul>
    </div>
    <div class="text-center">
        {!! $urun->links() !!}
    </div>






@endsection

@section('js')
    <script>
        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2()
        })
    </script>
@endsection
