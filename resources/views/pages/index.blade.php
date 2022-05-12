@extends('layouts.adminLayout')

@section('title')
@endsection

@section('css')
@endsection

@section('content')


    <div class="box box-primary" style="position: relative; left: 0px; top: 0px;">
        <div class="box-header ui-sortable-handle">
            <section class="content-header">
                <h1>
                    Yönetim paneline hoşgeldiniz.
                    <small>Panelinizi menülerden yönetebilirsiniz.</small>
                </h1>

            </section>

        </div>
    </div>




<section class="content-header">
    <h1>

        <small>Hızlı Linkler</small>
    </h1>

</section>

<!-- Main content -->
<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>{{ count($urun) }}</h3>

                    <p>Ürün Sayısı</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="{{route('admin.urunEkle')}}" class="small-box-footer">Daha fazlası <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
{{--        <div class="col-lg-3 col-xs-6">--}}
{{--            <!-- small box -->--}}
{{--            <div class="small-box bg-green">--}}
{{--                <div class="inner">--}}
{{--                    <h3>53<sup style="font-size: 20px">%</sup></h3>--}}

{{--                    <p>Bounce Rate</p>--}}
{{--                </div>--}}
{{--                <div class="icon">--}}
{{--                    <i class="ion ion-stats-bars"></i>--}}
{{--                </div>--}}
{{--                <a href="#" class="small-box-footer">Daha fazlası <i class="fa fa-arrow-circle-right"></i></a>--}}
{{--            </div>--}}
{{--        </div>--}}
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3>{{ count($user) }}</h3>
                    <p>Kullanıcı Kayıtları</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="{{route('admin.userList')}}" class="small-box-footer">Daha fazlası <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
                <div class="inner">
                    <h3>{{ count($fatura) }}</h3>

                    <p>Fatura Sayısı</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                <a href="{{route('admin.faturaListele')}}" class="small-box-footer">Daha fazlası <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
    </div>


@endsection

@section('js')
@endsection
