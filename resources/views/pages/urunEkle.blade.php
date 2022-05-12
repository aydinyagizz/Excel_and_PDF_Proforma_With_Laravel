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


                {{--                @if(session()->has('errors'))--}}
                {{--                    <div class="form-group alert alert-danger">--}}
                {{--                        <ul>--}}
                {{--                        @if ($errors->has('import_file'))--}}
                {{--                            Hata! Dosya uzantısı 'xls,xlsx' olmalıdır.--}}
                {{--                            @elseif($errors->has('errors'))--}}
                {{--                            {{ session()->get('errors') }}--}}
                {{--                        </ul>--}}
                {{--                        @endif--}}
                {{--                    </div>--}}
                {{--                @endif--}}

                @if(session()->has('success'))
                    <div class="form-group alert alert-success">
                        <ul>
                            {{ session()->get('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </ul>
                    </div>
                @endif


                @if($errors->count() > 0)
                    <div class="form-group alert alert-danger">
                        <ul>
                            @if ($errors->has('import_file'))
                                Hata! Dosya uzantısı 'xls,xlsx' olmalıdır.
                            @elseif($errors->has('errors'))
                                {{ session()->get('errors') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>

                            @endif
                            @foreach ($errors->all() as $error)
                                {{ $error }}

                            @endforeach

                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </ul>
                    </div>

                @endif
                <label type="text">Excelden ürün ekle</label>
                <div class="row">

                    <div class="col-md-3">
                        <label class="text" for="baslangicSatir">Ürünün başlangıç satırı <small>(Örn:1)</small></label>
                        <input type="number" name="baslangicSatir" class="form-control" min="1" value="1"
                               placeholder="Excel başlangıç satırı Örn:1" required>
                    </div>

                    <div class="col-md-2">
                        <label class="text" for="urunSatir">Ürün adının sütunu <small>(Örn:A)</small></label>
                        <input type="text" name="urunSutun" class="form-control" value="C"
                               placeholder="Ürün adının sütunu Örn:C" required>
                    </div>

                    <div class="col-md-2">
                        <label class="text" for="miktarSatir">Miktarın sütunu <small>(Örn:B)</small></label>
                        <input type="text" name="miktarSutun" class="form-control" value="E"
                               placeholder="Miktarın sütunu Örn:B" required>
                    </div>

                    {{--                    <div class="col-md-2">--}}
                    {{--                        <label class="text" for="birimSatir">Birimin geleceği alan <small>(Örn:C)</small></label>--}}
                    {{--                        <input type="text" name="birimSutun" class="form-control" value="Adet"--}}
                    {{--                               placeholder="Birimin geleceği alan Örn:B" required>--}}
                    {{--                    </div>--}}

                    <div class="col-xs-2">
                        <label class="text" for="malzemeFiyatSatir">Malzeme Fiyatı sütunu <small>(Örn:C)</small></label>
                        <input type="text" name="malzemeFiyatSutun" class="form-control" value="F"
                               placeholder="Malzeme Fiyatı sütunu Örn:F" required>
                    </div>

                    <div class="col-md-3">
                        <label class="text" for="urunKar">Uygulanacak yüzdelik kar <small>(Örn: 5, 10)</small></label>
                        <input type="number" name="urunKar" class="form-control" min="0" value="0"
                               placeholder="Uygulanacak yüzdelik kar Örn: 5, 10" required>
                    </div>
                </div>

                <hr>


                <input type="file" name="import_file"><br>
                <input type="submit" class="btn btn-primary" value="Exceli içe aktar">

            </form>
            <hr>
            <form action="{{url('urunEkle')}}" method="POST">
                @csrf

                <div class="box-footer clearfix no-border form-group">
                    <div class="row">

                        <div class="col-md-12">
                            <label class="text" for="siparisOzellik">Ürün Adı</label>
                            <input type="text" name="siparisOzellik" class="form-control"
                                   placeholder="Ürün Adı" required>
                        </div>


                        <div class="col-md-3">
                            <label class="text" for="miktar">Miktar</label>
                            <input type="number" min="0" name="miktar" class="form-control" placeholder="Miktar"
                                   required>
                        </div>

                        <div class="col-md-3">
                            <label class="text" for="birim">Birim</label>
                            <input type="text" name="birim" class="form-control" placeholder="Birim" required>
                        </div>

                        <div class="col-md-3">
                            <label class="text" for="malzemeFiyati">Malzeme Fiyatı</label>
                            <input type="number" min="0" step="0.01" name="malzemeFiyati" class="form-control"
                                   placeholder="Malzeme Fiyatı"
                                   required>
                        </div>

                        <div class="col-md-3">
                            <label class="text" for="urunKar">Ürüne uygulanacak yüzdelik kar <small>(Örn: 5, 10)</small></label>
                            <input type="number" name="urunKar" class="form-control" min="0" value="0"
                                   placeholder="Ürüne uygulanacak yüzdelik kar Örn: 5, 10" required>
                        </div>

                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Ekle</button>
                </div>
            </form>
        </div>

        {{--{{dd($teklif[0]->miktar)}}--}}


        <ul class="todo-list ui-sortable" id="myUL">

            <li class="" style="background-color: white !important;">
                <div class="" align="right">
                    <input class="search" id="myInput" type="text" placeholder="Arama..">
                    <br>
                    <br>
                </div>


                <table class="table" id="example">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Ürün Adı</th>
                        <th>Miktar</th>
                        <th>Birim</th>
                        <th>Kar</th>
                        <th>Malzeme Fiyatı</th>
                        <th>Karlı Malzeme Fiyatı</th>
                        <th>Ürün Tutar</th>

                        <th></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody id="myTable">

                    @php
                        $say = ($urun->currentpage()-1)* $urun->perpage() + 1;

                    @endphp
                    @foreach($urun as $urunItem)

                        <tr>
                            <td><b>{{$say++}}</b></td>
                            <td> {{$urunItem->siparisOzellik}} </td>
                            <td> {{$urunItem->miktar}} </td>
                            <td> {{$urunItem->birim}} </td>
                            <td> {{$urunItem->urunKar}} </td>
                            <td> {{$urunItem->malzemeFiyati}} </td>
                            @php
                                $urunMalzemeFiyati = ($urunItem->malzemeFiyati + ($urunItem->malzemeFiyati * ($urunItem->urunKar/100)));
                            @endphp
                            <td> {{$urunMalzemeFiyati}} </td>
                            <td> {{number_format((($urunItem->miktar)*($urunMalzemeFiyati)),2)}} </td>
{{--                            <td> {{($urunItem->created_at)->format('d/m/Y')}} </td>--}}
{{--                            <td><a href="teklifEdit/{{$teklif->id}}"><i class="fa fa-edit"></i></a></td>--}}
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


        <script>
            $(document).ready(function () {
                $("#myInput").on("keyup", function () {
                    var value = $(this).val().toLowerCase();
                    value = value.trim();
                    $("#myTable").filter(function () {
                        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                        console.log(value);
                    });
                });
            });
        </script>





@endsection
