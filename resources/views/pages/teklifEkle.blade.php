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
            {{--            <form action="{{url('teklifEkle/'.$Id)}}" method="POST">--}}
            {{--                @csrf--}}

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


            {{--                <div class="box-footer clearfix no-border form-group">--}}
            {{--                    <div class="row">--}}
            {{--                        <div class="col-md-12">--}}
            {{--                            <div class="form-group">--}}
            {{--                                <label>Ürün Adı <small>(*Bu alandan ürün eklemesi yapabilirsiniz.)</small></label>--}}
            {{--                                <select class="form-control select2 selectDiv1"--}}
            {{--                                        data-placeholder="Ürün Seçiniz" style="width: 100%;" tabindex="-1"--}}
            {{--                                        aria-hidden="true" name="siparisOzellik" id="siparisOzellik" required>--}}
            {{--                                    <option selected>Seçiniz</option>--}}
            {{--                                    @foreach($urun as $urunler)--}}
            {{--                                        <option id="option2" class="test"--}}
            {{--                                                value="{{$urunler->id}}">{{$urunler->siparisOzellik}}</option>--}}
            {{--                                    @endforeach--}}
            {{--                                </select>--}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                        --}}


            {{--                        <div class="col-md-4">--}}
            {{--                            <label class="text" for="miktar">Miktar</label>--}}
            {{--                            <input type="number" min="0" name="miktar" id="miktar" class="form-control" placeholder="Miktar"--}}
            {{--                                   required>--}}
            {{--                        </div>--}}

            {{--                        <div class="col-md-4">--}}
            {{--                            <label class="text" for="birim">Birim</label>--}}
            {{--                            <input type="text" name="birim" id="birim" class="form-control" placeholder="Adet" required>--}}
            {{--                        </div>--}}

            {{--                        <div class="col-md-4">--}}
            {{--                            <label class="text" for="malzemeFiyati">Malzeme Fiyatı</label>--}}
            {{--                            <input type="number" min="0" step="0.01" name="malzemeFiyati" id="malzemeFiyati" class="form-control"--}}
            {{--                                   placeholder="Malzeme Fiyatı"--}}
            {{--                                   required>--}}
            {{--                        </div>--}}

            {{--                    </div>--}}
            {{--                    <br>--}}
            {{--                    <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Ürün Ekle</button>--}}
            {{--                </div>--}}
            {{--            </form>--}}


            {{--            <form action="{{url('yuzdeEkle/'.$Id)}}" method="POST">--}}
            {{--                @csrf--}}
            {{--                <div class="box-footer clearfix no-border form-group">--}}
            {{--                    @if($errors->count() > 0)--}}
            {{--                        <div class="form-group alert alert-danger">--}}
            {{--                            <ul>--}}
            {{--                                @foreach ($errors->all() as $error)--}}
            {{--                                    {{ $error }}--}}
            {{--                                @endforeach--}}
            {{--                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">--}}
            {{--                                    <span aria-hidden="true">&times;</span>--}}
            {{--                                </button>--}}
            {{--                            </ul>--}}
            {{--                        </div>--}}

            {{--                    @endif--}}
            {{--                    <div class="row">--}}
            {{--                        <div class="col-md-3">--}}
            {{--                            <label class="text" for="iskonto">İskonto yüzdesi <small>(ÖRN: 5, 10) yüzde {{$user->karKisiti/2}} 'ı geçemez</small></label>--}}
            {{--                            <input type="number" name="iskonto" class="form-control"--}}
            {{--                                   placeholder="İskonto yüzdesi" min="0" value="{{$TeklifYapanKisi->iskonto}}" required--}}
            {{--                                   step="any">--}}
            {{--                        </div>--}}

            {{--                        <div class="col-md-3">--}}
            {{--                            <label class="text" for="iscilik">İşçilik</label>--}}
            {{--                            <input type="number" name="iscilik" class="form-control"--}}
            {{--                                   placeholder="İşçilik" min="0" value="{{$TeklifYapanKisi->iscilik}}" required--}}
            {{--                                   step="any">--}}
            {{--                        </div>--}}

            {{--                        <div class="col-md-3">--}}
            {{--                            <label class="text" for="yol">Yol</label>--}}
            {{--                            <input type="number" name="yol" class="form-control"--}}
            {{--                                   placeholder="Yol" min="0" value="{{$TeklifYapanKisi->yol}}" required step="any">--}}
            {{--                        </div>--}}
            {{--                    </div>--}}
            {{--                    <br>--}}
            {{--                    <button type="submit" class="btn btn-warning pull-right"><i class="fa fa-plus"></i> Faturayı Güncelle--}}
            {{--                    </button>--}}
            {{--                </div>--}}
            {{--            </form>--}}

            {{--            @php--}}
            {{--            dd($teklif, $Id, $TeklifYapanKisi, $user);--}}
            {{--            @endphp--}}


        </div>

    {{--{{dd($teklif[0]->miktar)}}--}}
    @php
        $urunTutar=0;
            foreach($teklif as $teklifler){
               $urunTutar += (($teklifler->miktar)*($teklifler->malzemeFiyati));

}
    @endphp


{{--        TODO: burası yapılacak user'a adres bilgisi eklenip pdf'de dinamik olacak--}}
    <!-- Modal -->
        <div class="modal fade bd-example-modal-lg" id="exampleModalLong" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Pdf için Adres Ekleme</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <label class="text" for="firmaAdi">Firma Adı</label>
                                    <input type="text" name="firmaAdi" class="form-control"
                                           placeholder="Firma Adı" min="0" value=""
                                           required>
                                </div>
                                <div class="col-md-12">
                                    <label class="text" for="adres">Adres</label>
                                    <textarea type="text" name="adres" class="form-control"
                                              placeholder="Adres" value=""
                                              required></textarea>
                                </div>
                                <div class="col-md-12">
                                    <label class="text" for="telefon">Telefon</label>
                                    <input type="text" id="telefon" name="telefon" class="form-control"
                                           value="" data-inputmask="'mask': '(999) 999 99 99'"
                                           required placeholder="(___) ___ __ __">
                                    {{--                                pattern="[0-9]{10}"--}}
                                    {{--                                pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}"--}}
                                </div>

                                <div class="col-md-12">
                                    <label class="text" for="email">Email</label>
                                    <input type="email" name="email" class="form-control"
                                           placeholder="Email" min="0" value=""
                                           required>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
{{--                            <button type="button" class="btn btn-primary">Adresi Kaydet</button>--}}
                            <a href="" type="submit" class="btn btn-primary">Adresi Kaydet</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{--end modal--}}


        <ul class="todo-list ui-sortable">

            <li class="" style="background-color: white !important;">

                <table class="table">

                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Ürün Adı</th>
                        <th>Miktar</th>
                        <th>Birim</th>
                        <th>Malzeme Fiyatı</th>
                        <th>Ürün Tutar</th>
                        <th>Kârlı Ürün Tutar</th>
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
                            <td> {{number_format($teklif->malzemeFiyati, 2)}} </td>
                            @php
                                $urunTutar = (($teklif->miktar)*($teklif->malzemeFiyati));

                            @endphp
                            <td> {{number_format($urunTutar, 2)}} </td>
                            @php
                                $karliUrunTutar = ($urunTutar + ($urunTutar * (($TeklifYapanKisi->karOrani)/100)));

                            @endphp
                            <td> {{ number_format($karliUrunTutar, 2) }} </td>
                            {{--                            <td> {{ $karliUrunTutar = number_format((($teklif->miktar)*($teklif->malzemeFiyati)) + ((($teklif->miktar)*($teklif->malzemeFiyati)) * ($TeklifYapanKisi->karOrani/100)),2) }} </td>--}}
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
            <div align="left" class="col-md-6 row" style="margin-bottom: 30px !important;">


                @role('Admin')

                <div class="col-md-3">
                    <h4>Teklif Formu</h4>
                    <a href="{{ url('export/'.$Id )}}" class="btn btn-success"><input type="hidden"
                                                                                      value="{{$TeklifYapanKisi->karOrani}}"
                                                                                      method="POST" name="karOrani"><i
                            class="fa fa-download"></i> Excel
                        indir</a>


                </div>
                @endrole
                @php
                    session()->put('karOrani', $TeklifYapanKisi->karOrani);
                    session()->put('karliUrunTutar', $karliUrunTutar);
                @endphp
                <div class="col-md-3">
                    <h4>Fatura</h4>
                    <a href="{{ url('teklifPdf/'.$Id )}}" class="btn btn-primary"><i class="fa fa-download"></i> PDF
                        Oluştur</a>

                </div>

                <div class="col-md-5">
                    <h4>Fatura İçin Adres </h4>
                    <a href="" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong"><i
                            class="fa fa-download"></i> PDF
                        Oluştur</a>

                </div>

            </div>

        </ul>
    </div>





@endsection

@section('js')
    <script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/jquery.inputmask.bundle.js"></script>
    <script type="text/javascript">
        $(":input").inputmask();

        $("#telefon").inputmask({"mask": "(999) 999-9999"});
    </script>


    <script>
        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2()
        })
    </script>

    <script type="text/javascript">
        $(document).ready(function () {
            // $('select[id=siparisOzellik]').change(function(){
            $('.select2').change(function () {
                //alert("testik");
                var urun = document.getElementById('siparisOzellik').value;


                // alert();
                // var birimId = document.getElementById('siparisOzellik').value;
                // var malzemeFiyatiId = document.getElementById('siparisOzellik').value;

                $.ajax({
                    headers: {'X-CSRF-TOKEN': '{{csrf_token()}}'},
                    url: '{{route('admin.faturaDetayGetir')}}',
                    type: 'POST',
                    data: {id: urun},
                    success: function (data) {
                        if ($.trim(data) != '') {
                            $('#miktar').val(data.urunDetay.miktar);
                            $('#birim').val(data.urunDetay.birim);
                            $('#malzemeFiyati').val(data.urunDetay.malzemeFiyati);
                        } else {
                            alert("İlgili Kaydın verisi bulunamadı.");
                        }
                    }

                })

            });
        });
    </script>



@endsection
