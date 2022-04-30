@extends('layouts.adminLayout')

@section('title')
@endsection

@section('css')
@endsection

@section('content')

    <div class="box box-primary" style="position: relative; left: 0px; top: 0px;">
        <div class="box-header ui-sortable-handle">
            <section class="content-header">
                <i class="ion ion-clipboard fa-2x"></i>
                <h3 class="box-title"> Fatura Düzenle</h3>

                <ol class="breadcrumb">
                    <li><a href="{{route('admin.index')}}"></i> Anasayfa</a></li>
                    <li><a href="{{Illuminate\Support\Facades\URL::previous() }}"></i> Fatura Ekle</a></li>
                    <li class="active">Fatura Düzenle</li>
                </ol>

            </section>


        </div>
        <div class="box-body">
            <form action="{{ route('admin.faturaEdit') }}" method="POST">
                @csrf

                <input type="hidden" name="id" value="{{$faturaEdit->id}}">
                <div class="box-footer clearfix no-border form-group">
                    <div>
                        <label class="text" for="musteriAdSoyad">Müşteri Ad Soyad</label>
                        <input type="text" name="musteriAdSoyad" class="form-control" placeholder="Müşteri Ad Soyad" required value="{{$faturaEdit->musteriAdSoyad}}">
                    </div>

{{--                    <div class="row ">--}}
{{--                        <div class="col-md-3 mt-2">--}}
{{--                            <label class="text" for="faturaNo">Fatura No</label>--}}
{{--                            <input type="number" disabled name="faturaNo" class="form-control" placeholder="Fatura No" value="{{}}">--}}
{{--                        </div>--}}

{{--                    </div>--}}
                    <br>
                    <button type="submit" class="btn btn-default pull-right"><i class="fa fa-pencil"></i> Düzenle</button>
                </div>
            </form>
        </div>
    </div>


@endsection

@section('js')
@endsection
