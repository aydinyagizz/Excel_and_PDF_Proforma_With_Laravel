@extends('layouts.adminLayout')

@section('title')
@endsection

@section('css')
@endsection

@section('content')
    @php
        use Barryvdh\DomPDF\Facade\Pdf;

    @endphp
    <section class="invoice">
        <!-- title row -->
        <div class="row">
            <div class="col-xs-12">
                <h2 class="page-header">
                    {{--                    <i class="fa fa-globe"></i> DGH--}}
                    <img width="100" src=" {{asset("assets/dist/img/dgh1.png")}}" alt="">
                    <small class="pull-right">Tarih: {{date('d/m/Y')}}</small>
                </h2>
            </div>
            <!-- /.col -->
        </div>
        <!-- info row -->
        <div class="row invoice-info">
            <div class="col-sm-4 invoice-col">
                Firmadan
                <address>
                    <strong>DGH AR-GE YAZILIM DANIŞMANLIK ENERJİ EĞİTİM İNŞ. SAN. TİC. LTD.ŞTİ</strong><br>
                    Bulgurlu Mah. Kanyon Cd.Teknokent C No: 89/2 /102 Battalgazi/MALATYA<br>
                    Telefon: 0 506 116 40 66<br>
                    Email: dghticaret@gmail.com
                </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col">
                Firmaya
                <address>
                    <strong>{{$TeklifYapanKisi->musteriAdSoyad}}</strong><br>
                    {{--                    795 Folsom Ave, Suite 600<br>--}}
                    {{--                    San Francisco, CA 94107<br>--}}
                    {{--                    Phone: (555) 539-1037<br>--}}
                    {{--                    Email: john.doe@example.com--}}
                </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col">
                <b>Fatura No: {{ $TeklifYapanKisi->faturaNo}}</b><br>
                <br>
                {{--                <b>Order ID:</b> 4F3S8J<br>--}}
                <b>Fatura Oluşturulma Tarihi: </b> {{ date_format($TeklifYapanKisi->created_at, 'd/m/Y')}}<br>
                {{--                <b>Account:</b> 968-34567--}}
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->


    <?php

    $sub_total = 0;
    foreach ($teklif as $teklifler) {

        $sub_total += ((int)$teklifler->miktar * (int)$teklifler->malzemeFiyati);

    }
    $sub_total += (($TeklifYapanKisi->iscilik) + ($TeklifYapanKisi->yol));

    ?>





    <!-- Table row -->
        <div class="row">
            <div class="col-xs-12 table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Sipariş ve Özellikler</th>
                        <th>Miktar</th>
                        <th>Birim</th>
                        {{--                        <th>Malzeme Fiyatı</th>--}}
                        {{--                        <th>Ürün Tutar</th>--}}
                    </tr>

                    </thead>
                    <tbody>
                    @foreach($teklif as $teklif)
                        <tr>
                            <td>{{$teklif->siparisOzellik}}</td>
                            <td>{{$teklif->miktar}}</td>
                            <td>{{$teklif->birim}}</td>
                            {{--                            <td>{{$teklif->malzemeFiyati}}</td>--}}
                            {{--                            <td>{{number_format((($teklif->miktar)*($teklif->malzemeFiyati)),2)}} $</td>--}}
                        </tr>
                    @endforeach

                    <tr>
                        <td>Anahtar Teslim Montaj ve Test
{{--                            : {{number_format(($TeklifYapanKisi->iscilik) + ($TeklifYapanKisi->yol), 2)}} $--}}
                        </td>
                        <td>1</td>
                        <td>adet</td>
                    </tr>

                    </tbody>
                </table>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="row">
            <!-- accepted payments column -->
            <div class="col-xs-6">


                {{--                <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">--}}
                {{--                    Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem plugg--}}
                {{--                    dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.--}}
                {{--                </p>--}}
            </div>
            <!-- /.col -->
            <div class="col-md-6">
                <p class="lead">Miktar</p>

                <div class="table-responsive">
                    <table class="table">
                        <tbody>

                        @php(number_format( $karliTutar = (($sub_total))+(($sub_total)*($TeklifYapanKisi->yuzdelikKar/100)),2) )


                        <tr>
                            <th>KDV</th>
                            <td>%18</td>
                        </tr>
                        <tr>

                            @php(number_format($kdvTutar = $karliTutar * (18/100), 2))

                        </tr>
                        <tr>

                            <th>Toplam:</th>
                            <td>{{ number_format(( $toplam = $karliTutar + $kdvTutar), 2) }} $</td>

                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>


        <!-- this row will not appear when printing -->
        <div class="row no-print">
            <div class="col-xs-12">
                <a href="" onClick="window.print();" class="btn btn-primary"><i class="fa fa-print"></i> Yazdır</a>


                {{--                onClick="window.print();"--}}
                <a href="{{url('pdfDownload/'.$Id)}}" class="btn btn-primary pull-right"><i class="fa fa-download"></i>
                    PDF indir</a>
            </div>
        </div>
    </section>

@endsection

@section('js')
@endsection
