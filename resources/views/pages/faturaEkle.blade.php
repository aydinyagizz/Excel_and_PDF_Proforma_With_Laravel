@extends('layouts.adminLayout')

@section('title')
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset("assets/bower_components/select2/dist/css/select2.min.css")}}">
@endsection

@section('content')


    @php

        @endphp
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
                                <label>Sipariş ve özellikler</label>
                                <select class="form-control select2"
                                        data-placeholder="Ürün Seçiniz" style="width: 100%;" tabindex="-1"
                                        aria-hidden="true" name="siparisOzellik[]">
                                    @foreach($urun as $urunler)
                                        <option
                                            value="{{$urunler->siparisOzellik}}">{{$urunler->siparisOzellik}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>




                        <div class="col-md-2">
                            <label class="text" for="miktar">Miktar</label>
                            <input type="number" min="0" name="miktar[]" class="form-control" placeholder="Miktar"
                                   required value="{{$urun[0]->miktar}}">
                        </div>

                        <div class="col-md-2">
                            <label class="text" for="birim">Birim</label>
                            <input type="text" name="birim[]" class="form-control" placeholder="Birim" required>
                        </div>

                        <div class="col-md-2">
                            <label class="text" for="malzemeFiyati">Malzeme Fiyatı</label>
                            <input type="number" min="0" name="malzemeFiyati[]" class="form-control" placeholder="Malzeme Fiyatı" required>
                        </div>

                        <div class="col-md-12" id="button_pro">

                            <div class='space' id='input_1' align="right">
                                <i class="fa fa-plus add right" style="cursor: pointer"> Ekle</i>
                            </div>
                        </div>

                    </div>

                    <br>


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

    {{--    <script>--}}
    {{--        $('document').ready(function(){--}}
    {{--            var id=2,txt_box;--}}
    {{--            $('#button_pro').on('click','.add',function(){--}}
    {{--                $(this).remove();--}}
    {{--                txt_box='<div class="space" id="input_'+id+'" ><input type="text" name="val[]" class="left txt"/><img src="images/remove.png" class="remove"/><img class="add right" src="images/add.png" /></div>';--}}
    {{--                $("#button_pro").append(txt_box);--}}
    {{--                id++;--}}
    {{--            });--}}
    {{--            --}}
    {{--        });--}}
    {{--    </script>--}}


    {{--    <script>--}}
    {{--        $('document').ready(function () {--}}
    {{--            var id = 2, txt_box;--}}
    {{--            $('#button_pro').on('click', '.add', function () {--}}
    {{--                $(this).remove();--}}
    {{--                txt_box = '<div class="space" id="input_' + id + '" ><input type="text" name="val[]" class="left txt"/><i class="fa fa-trash remove"></i><i class="fa fa-plus add right"></i></div>';--}}
    {{--                $("#button_pro").append(txt_box);--}}
    {{--                id++;--}}
    {{--            });--}}

    {{--            $('#button_pro').on('click', '.remove', function () {--}}
    {{--                var parent = $(this).parent().prev().attr("id");--}}
    {{--                var parent_im = $(this).parent().attr("id");--}}
    {{--                $("#" + parent_im).slideUp('medium', function () {--}}
    {{--                    $("#" + parent_im).remove();--}}
    {{--                    if ($('.add').length < 1) {--}}
    {{--                        $("#" + parent).append('<i class="fa fa-plus add right"></i>');--}}
    {{--                    }--}}
    {{--                });--}}
    {{--            });--}}


    {{--        });--}}
    {{--    </script>--}}




    <script>
        $('document').ready(function () {

            var id = 2, txt_box;
            $('#button_pro').on('click', '.add', function () {
                $(this).remove();
                txt_box = '<div class="row" id="input_' + id + '"><div class="col-md-5"><div class="form-group"><label>Sipariş ve özellikler</label><select class="form-control select2"  id="siparisOzellik' + id + '" name="siparisOzellik[]" data-placeholder="Ürün Seçiniz" style="width: 100%;" tabindex="-1" aria-hidden="true">"@foreach($urun as $urunler)<option>{{$urunler->siparisOzellik}}</option>@endforeach"</select></div></div><div class="col-md-2"><label class="text" for="miktar">Miktar</label><input type="number" min="0" id="miktar' + id + '" name="miktar[]" class="form-control" placeholder="Miktar" required value="@foreach($urun as $urunler){{$urun[0]->miktar}}@endforeach"></div><div class="col-md-2"><label class="text" for="birim">Birim</label><input type="text" id="birim' + id + '" name="birim[]" class="form-control" placeholder="Birim" required></div><div class="col-md-2"><label class="text" for="malzemeFiyati">Malzeme Fiyatı</label><input type="number" min="0" name="malzemeFiyati[]" class="form-control" placeholder="Malzeme Fiyatı" required></div><i class=" fa fa-trash remove" style="cursor: pointer"> Sil </i> <i class="fa fa-plus add right" style="cursor: pointer"> Ekle </i></div>';
                $("#button_pro").append(txt_box);
                id++;

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
                        $("#" + parent).append('<i class="fa fa-plus add right" style="cursor: pointer"> Ekle</i>');
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

@endsection
