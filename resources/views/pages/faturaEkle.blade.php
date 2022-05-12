@extends('layouts.adminLayout')

@section('title')
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset("assets/bower_components/select2/dist/css/select2.min.css")}}">

@endsection

@section('content')

    <div class="box box-primary" style="position: relative; left: 0px; top: 0px;">
        <div class="box-header ui-sortable-handle">
            <section class="content-header">
                <i class="ion ion-clipboard fa-2x"></i>

                <h3 class="box-title">Fatura Ekle</h3>

                <ol class="breadcrumb">
                    <li><a href="{{route('admin.index')}}"> Anasayfa</a></li>
                    <li class="active">Fatura Ekle</li>
                </ol>
            </section>

        </div>
        <div class="box-body">
            <form action="{{ route('admin.faturaAdd') }}" method="POST">
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

                <div class="box-footer clearfix no-border form-group advice">
                    <div class="row">


                        <div class="col-md-12">
                            <label class="text" for="musteriAdSoyad">Müşteri Ad Soyad</label>
                            <input type="text" name="musteriAdSoyad" class="form-control aa"
                                   placeholder="Müşteri Ad Soyad"
                                   required>
                        </div>


                        <div class="col-md-5">
                            <div class="form-group">
                                <label>Ürün Adı</label>
                                <select class="form-control select2 selectDiv1"
                                        data-placeholder="Ürün Seçiniz" style="width: 100%;" tabindex="-1"
                                        aria-hidden="true" name="siparisOzellik[]" id="siparisOzellik1" required>
                                    <option selected>Seçiniz</option>
                                    @foreach($urun as $urunler)
                                        <option id="option2" class="test"
                                                value="{{$urunler->id}}">{{$urunler->siparisOzellik}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <div class="col-md-2">
                            <label class="text" for="miktar">Miktar</label>
                            <input type="number" min="0" name="miktar[]" id="miktar" class="form-control"
                                   placeholder="Miktar"
                                   required value="">
                        </div>

                        <div class="col-md-2">
                            <label class="text" for="birim">Birim</label>
                            <input type="text" name="birim[]" id="birim" class="form-control" placeholder="Birim"
                                   value=""
                                   required>
                        </div>

                        <div class="col-md-2" id="1">
                            <label class="text" for="malzemeFiyati">Malzeme Fiyatı</label>
                            <input type="number" min="0" step="0.01" id="malzemeFiyati" {{ $user->roles[0]->name == 'Admin' ? '' : 'disabled'  }} name="malzemeFiyati[]" class="form-control"
                                   placeholder="Malzeme Fiyatı" value="" required>
                        </div>

                        <div class="col-md-12" id="button_pro">

                            <div class='space' id='input_1' align="right">
                                <i class="fa fa-plus add right" style="cursor: pointer"> Satır Ekle</i>
                            </div>
                        </div>

                    </div>

                    <br>

{{--                    <div class="col-md-3">--}}
{{--                        <label class="text" for="iskonto">İskonto yüzdesi <small>(ÖRN: 5, 10) yüzde 5 'ı geçemez</small></label>--}}
{{--                        <input type="number" name="iskonto" class="form-control" placeholder="İskonto yüzdesi" min="0" value="0" required="" step="any">--}}
{{--                    </div>--}}

                    <div class="row">
                        <div class="col-md-3">
                            <label class="text" for="karOrani">Ürünlere uygulanacak kâr oranı <small>(ÖRN: 5, 10)</small></label>
                            <input type="number" name="karOrani" class="form-control"
                                   placeholder="Ürünlere uygulanacak kâr oranı" min="0" value="0" required
                                   step="any">
                        </div>

                        <div class="col-md-3">
                            <label class="text" for="iscilik">İşçilik</label>
                            <input type="number" name="iscilik" class="form-control"
                                   placeholder="İşçilik" min="0" value="0" required
                                   step="any">
                        </div>

                        <div class="col-md-3">
                            <label class="text" for="yol">Yol</label>
                            <input type="number" name="yol" class="form-control"
                                   placeholder="Yol" min="0" value="0" required step="any">
                        </div>
                    </div>


                </div>


                <div class="box-body">
                    <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-check"></i> Faturayı
                        Tamamla
                    </button>
                </div>


            </form>
        </div>
    </div>


@endsection

@section('js')



    <script>

        var user = {!! auth()->user() !!};

        var id = 2;

        $('document').ready(function () {

            var txt_box;
            $('#button_pro').on('click', '.add', function () {

                $(this).remove();
                txt_box = '<div class="row" id="input_' + id + '"><div class="col-md-5"><div class="form-group"><label>Ürün Adı</label><select class="form-control select2 selectDiv "  id="siparisOzellik' + id + '" name="siparisOzellik[]" data-placeholder="Ürün Seçiniz" style="width: 100%;" tabindex="-1" aria-hidden="true" required>"<option selected>Seçiniz</option>@foreach($urun as $urunler)<option value="{{$urunler->id}}">{{$urunler->siparisOzellik}}</option>@endforeach"</select></div></div><div class="col-md-2"><label class="text" for="miktar">Miktar</label><input type="number" min="0" id="miktar' + id + '" name="miktar[]" class="form-control" placeholder="Miktar" required value=""></div><div class="col-md-2"><label class="text" for="birim">Birim</label><input type="text" id="birim' + id + '" name="birim[]" class="form-control" placeholder="Birim" required></div><div class="col-md-2"><label class="text" for="malzemeFiyati">Malzeme Fiyatı</label><input type="number" min="0" step="0.01" id="malzemeFiyati' + id + '" {{ $user->roles[0]->name == 'Admin' ? '' : 'disabled'  }} name="malzemeFiyati[]" class="form-control" placeholder="Malzeme Fiyatı" required></div><i class=" fa fa-trash remove" style="cursor: pointer"> Sil </i> <i class="fa fa-plus add right" style="cursor: pointer"> Satır Ekle </i></div>';
                $("#button_pro").append(txt_box);
                id++;


                $('select.select2').change(function () {
                    var urunler = $(this).children("option:selected").val();

                    $.ajax({
                        headers: {'X-CSRF-TOKEN': '{{csrf_token()}}'},
                        url: '{{route('admin.faturaDetayGetir')}}',
                        type: 'POST',
                        data: {id: urunler},
                        success: function (data) {
                            if ($.trim(data) != '') {

                                var miktarVar = 'miktar'+(id-1);
                                var birimVar = 'birim'+(id-1);
                                var malzemeFiyatiVar = 'malzemeFiyati'+(id-1);
                                var karliMalzemeFiyati = (((data.urunDetay.malzemeFiyati) + (data.urunDetay.malzemeFiyati * (data.urunDetay.urunKar/100)))).toFixed(2);
                                var iskontoluMalzemeFiyati = ((karliMalzemeFiyati - (karliMalzemeFiyati) * (user.iskontoKisiti/100))).toFixed(2);

                                $('#'+miktarVar).val(data.urunDetay.miktar);
                                $('#'+birimVar).val(data.urunDetay.birim);
                                if(userRole == 'Admin') {
                                    $('#' + malzemeFiyatiVar).val(karliMalzemeFiyati);
                                }if(userRole == 'Kullanıcı') {
                                    $('#' + malzemeFiyatiVar).val(iskontoluMalzemeFiyati);
                                }else{
                                    $('#' + malzemeFiyatiVar).val(iskontoluMalzemeFiyati);
                                }
                            } else {
                                alert("İlgili Kaydın verisi bulunamadı.");
                            }
                        }

                    })
                });


                $(function () {
                    //Initialize Select2 Elements
                    $('.select2').select2()
                })
            });


            $('#button_pro').on('click', '.remove', function () {
                var parent = $(this).parent().prev().attr("id");
                var parent_im = $(this).parent().attr("id");
                $("#" + parent_im).slideUp('medium', function () {
                    $("#" + parent_im).remove();
                    if ($('.add').length < 1) {
                        $("#" + parent).append('<i class="fa fa-plus add right" style="cursor: pointer"> Satır Ekle</i>');
                    }
                });
            });


        });

    </script>


    <script>
        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2()
        })
    </script>

    <script type="text/javascript">

        var user = {!! auth()->user() !!};
        var userRole = '{!! auth()->user()->roles[0]->name !!}';

        $(document).ready(function () {
            // $('select[id=siparisOzellik]').change(function(){
            $('.select2-hidden-accessible').change(function () {
                //alert("testik");
                var urun = document.getElementById('siparisOzellik1').value;


                // alert();
                // var birimId = document.getElementById('siparisOzellik').value;
                // var malzemeFiyatiId = document.getElementById('siparisOzellik').value;

                $.ajax({
                    headers: {'X-CSRF-TOKEN':'{{csrf_token()}}'},
                    url: '{{route('admin.faturaDetayGetir')}}',
                    type: 'POST',
                    data: { id: urun },
                    success:function(data){
                        if ($.trim(data) != '') {
                            var karliMalzemeFiyati = (((data.urunDetay.malzemeFiyati) + (data.urunDetay.malzemeFiyati * (data.urunDetay.urunKar/100)))).toFixed(2);
                            console.log("karlı fiyat "+karliMalzemeFiyati);
                            var iskontoluMalzemeFiyati = ((karliMalzemeFiyati - (karliMalzemeFiyati) * (user.iskontoKisiti/100))).toFixed(2);
                            console.log("iskontolu fiyat "+iskontoluMalzemeFiyati);

                            $('#miktar').val(data.urunDetay.miktar);
                            $('#birim').val(data.urunDetay.birim);
                            if(userRole == 'Admin'){
                                $('#malzemeFiyati').val(karliMalzemeFiyati);
                            }if(userRole == 'Kullanıcı'){
                                $('#malzemeFiyati').val(iskontoluMalzemeFiyati);
                            } else {
                                $('#malzemeFiyati').val(iskontoluMalzemeFiyati);
                            }

                        }
                        else{
                            alert("İlgili Kaydın verisi bulunamadı.");
                        }
                    }

                })

            });
        });
    </script>

    <script src="{{asset("assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js")}}"></script>
    <script src="{{mix('js/app.js')}}"></script>
@endsection
