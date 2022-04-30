@extends('layouts.adminLayout')

@section('title')
@endsection

@section('css')
@endsection

@section('content')

@php

@endphp
    <div class="box box-primary" style="position: relative; left: 0px; top: 0px;">
        <div class="box-header ui-sortable-handle">
{{--            <i class="ion ion-clipboard"></i>--}}

{{--            <h3 class="box-title">Teklif Düzenle</h3>--}}

            <section class="content-header">
                <i class="ion ion-clipboard fa-2x"></i>
                <h3 class="box-title"> Ürün Düzenle</h3>

                <ol class="breadcrumb">
                    <li><a href="{{route('admin.index')}}"></i> Anasayfa</a></li>
{{--                    <li><a href="{{Illuminate\Support\Facades\URL::previous() }}"></i> Teklif Ekle</a></li>--}}
                    <li><a href="{{ url('urunEkle')}}"></i> Ürün Ekle</a></li>
                    <li class="active">Ürün Düzenle</li>
                </ol>

            </section>

        </div>
        <div class="box-body">
            <form action="{{route('admin.urunEdit')}} " method="POST">
                @csrf

                <input type="hidden" name="id" value="{{$data['urunEdit']->id}}">

            <div class="box-footer clearfix no-border form-group">
                <div>
                <label class="text" for="siparisOzellik">Sipariş ve özellikler</label>
                <input type="text" name="siparisOzellik" class="form-control" placeholder="Sipariş ve özellikler" required value="{{$data['urunEdit']->siparisOzellik}}">
                </div>

                <div class="row">
                    <div class="col-md-4">
                    <label class="text" for="miktar">Miktar</label>
                    <input type="number" name="miktar" class="form-control" placeholder="Miktar" required value="{{$data['urunEdit']->miktar}}">
                    </div>

                    <div class="col-md-4">
                        <label class="text" for="birim">Birim</label>
                        <input type="text" name="birim" class="form-control" placeholder="Birim" required value="{{$data['urunEdit']->birim}}">
                    </div>

                    <div class="col-md-4">
                        <label class="text" for="malzemeFiyati">Malzeme Fiyatı</label>
                        <input type="number" name="malzemeFiyati" class="form-control" placeholder="Malzeme Fiyatı" required value="{{$data['urunEdit']->malzemeFiyati}}">
                    </div>


                </div>
                <br>
                <button type="submit" class="btn btn-default pull-right"><i class="fa fa-pencil"></i> Düzenle</button>
            </div>
            </form>
{{--{{dd($teklif[0]->miktar)}}--}}


        </div>

    </div>



@endsection

@section('js')
@endsection
