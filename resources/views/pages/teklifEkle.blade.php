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
                <h3 class="box-title"> Teklif Ekle</h3>

                <ol class="breadcrumb">
                    <li><a href="{{route('admin.index')}}"></i> Anasayfa</a></li>
                    <li><a href="{{route('admin.faturaEkle')}}"></i> Fatura Ekle</a></li>
                    <li class="active">Teklif Ekle</li>
                </ol>

            </section>

        </div>
        <div class="box-body">
            {{--            <form action="{{route('admin.teklifEkle')}}" method="POST">--}}
            <form action="{{url('teklifEkle/'.$Id)}}" method="POST">
                @csrf

                <input type="hidden" name="id" value="{{$Id}}">
                <div class="col-md-6" align="center">
                    <div class="box box-warning box-solid">
                        <div class="box-header with-border">
                            <h3 class="box-title">{{$TeklifYapanKisi->musteriAdSoyad}}</h3>

                        </div>
                    </div>
                </div>

                <div class="col-md-3" align="center">
                    <div class="box box-warning box-solid">
                        <div class="box-header with-border">
                            <h3 class="box-title">{{$TeklifYapanKisi->faturaNo}}</h3>

                        </div>
                    </div>
                </div>


                <div class="box-footer clearfix no-border form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Sipariş ve özellikler</label>
                                <select class="form-control select2 select2-hidden-accessible"
                                        data-placeholder="Select a State" style="width: 100%;" tabindex="-1"
                                        aria-hidden="true">
                                    <option>Alabama</option>
                                    <option>Alaska</option>
                                    <option>California 23</option>
                                    <option>Delaware</option>
                                    <option>Tennessee</option>
                                    <option>Texas</option>
                                    <option>Washington</option>
                                </select>
                            </div>
                        </div>


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


            <form action="{{url('yuzdeEkle/'.$Id)}}" method="POST">
                @csrf
                <div class="box-footer clearfix no-border form-group">

                    <div class="row">
                        <div class="col-md-3">
                            <label class="text" for="yuzdelikKar">Yüzdelik Kar <small>(ÖRN: 10, 20)</small></label>
                            <input type="number" name="yuzdelikKar" class="form-control"
                                   placeholder="Yüzdelik Kar" min="0" value="{{$TeklifYapanKisi->yuzdelikKar}}" required
                                   step="any">
                        </div>

                        <div class="col-md-3">
                            <label class="text" for="iscilik">İşçilik</label>
                            <input type="number" name="iscilik" class="form-control"
                                   placeholder="İşçilik" min="0" value="{{$TeklifYapanKisi->iscilik}}" required
                                   step="any">
                        </div>

                        <div class="col-md-3">
                            <label class="text" for="yol">Yol</label>
                            <input type="number" name="yol" class="form-control"
                                   placeholder="Yol" min="0" value="{{$TeklifYapanKisi->yol}}" required step="any">
                        </div>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-pencil"></i> Düzenle
                    </button>
                </div>
            </form>


            <div align="left" class="col-md-6 row" style="margin-bottom: 30px !important;">

                <div class="col-md-3">
                    <h4>Teklif Formu</h4>
                    <a href="{{ url('export/'.$Id )}}" class="btn btn-primary"><i class="fa fa-download"></i> Excel
                        indir</a>
                </div>
                <div class="col-md-3">
                    <h4>Fatura</h4>
                    <a href="{{ url('teklifPdf/'.$Id )}}" class="btn btn-primary"><i class="fa fa-download"></i> PDF
                        Oluştur</a>
                </div>
            </div>


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
                        <th>Ekleme Tarihi</th>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @php
                        $say=1;
                    @endphp
                    @foreach($teklif as $teklif)

                        <tr>
                            <td>{{$say}}</td>
                            <td> {{$teklif->siparisOzellik}} </td>
                            <td> {{$teklif->miktar}} </td>
                            <td> {{$teklif->birim}} </td>
                            <td> {{$teklif->malzemeFiyati}} </td>
                            <td> {{number_format((($teklif->miktar)*($teklif->malzemeFiyati)),2)}} </td>
                            <td> {{($teklif->created_at)->format('d/m/Y')}} </td>
                            {{--                            <td><a href="teklifEdit/{{$teklif->id}}"><i class="fa fa-edit"></i></a> </td>--}}
                            <td><a href="{{url('teklifEdit/'.$teklif->id)}}"><i class="fa fa-edit"></i></a></td>
                            <td><a href="{{url('teklifDelete/'.$teklif->id)}}"><i class="fa fa-trash-o"></i> </a>
                            </td>
                        </tr>
                        @php
                            $say++;
                        @endphp
                    @endforeach
                    </tbody>

                </table>
            </li>

        </ul>
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
