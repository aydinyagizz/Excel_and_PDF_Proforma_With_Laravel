<!doctype html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    {{--    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9"/>--}}
    {{--    <meta http-equiv="Content-Type" content="text/html; charset=windows-1254"/>--}}
    {{--    <meta name="viewport"--}}
    {{--          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">--}}

    {{--    <meta http-equiv="X-UA-Compatible" content="ie=edge">--}}




    {{--    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">--}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <style>
        body {
            font-family: DejaVu Sans;
            font-size: 12px;
        }
    </style>
    <title></title>
</head>
<body>
<section class="invoice">
    <!-- title row -->
    <div class="row">
        <div class="col-xs-12">
            <h2 class="page-header">

                <img class="logo" width="180" src="{{public_path('/assets/dghLogo.png')}}" alt=""
                     style="  position: absolute; right: 0px; ">
                <h6 style="margin-top: 130px;  position: absolute; right: 0px; ">Tarih: {{date('d/m/Y')}}</h6>
            </h2>

        </div>

    </div>

    <div class="row invoice-info">
        <div class="col-md-4">
            {{--            Firmadan--}}
            <address>
                <strong>DGH AR-GE YAZILIM DANIŞMANLIK ENERJİ EĞİTİM İNŞ. SAN. TİC. LTD.ŞTİ</strong><br>
                Bulgurlu Mah. Kanyon Cd.Teknokent C No: 89/2 /102 Battalgazi/MALATYA<br>
                Telefon: 0 (506) 116 40 66<br>
                Email: dghticaret@gmail.com
            </address>
        </div>


        <div class="col-md-4 ">
            <strong><p>Müşteri Bilgileri</p></strong>

            Sipariş Yetkilisi: <strong>{{$TeklifYapanKisi->musteriAdSoyad}}</strong><br>

        </div>


        <div class="col-md-4 invoice-col">
            {{--            <b>Fatura No: {{ $TeklifYapanKisi->faturaNo}}</b><br>--}}

            {{--            <b>Fatura Oluşturulma Tarihi: </b> {{ date_format($TeklifYapanKisi->created_at, 'd/m/Y')}}<br>--}}

        </div>
    </div>
    <br>
    <br>


    <?php

    $sub_total = 0;
    foreach ($teklif as $teklifler) {

        //$sub_total += ((int)$teklifler->miktar * (int)$teklifler->malzemeFiyati);
        $sub_total += $teklifler->miktar * ($teklifler->malzemeFiyati+ ($teklifler->malzemeFiyati * ($karOrani/100)));
    }

    $sub_total += (($TeklifYapanKisi->iscilik)+($TeklifYapanKisi->yol));

    ?>


    <div style="page-break-after:auto;">

        <div class=" my-content">
            <div class="row">

                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Ürün Adı</th>
                        <th>Miktar</th>
                        <th>Birim</th>
                        {{--                    <th>Malzeme Fiyatı </th>--}}
{{--                        <th>Toplam Tutar</th>--}}
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($teklif as $teklif)
                        <tr>
                            <td>{{$teklif->siparisOzellik}}</td>
                            <td>{{$teklif->miktar}}</td>
                            <td>{{$teklif->birim}}</td>
                            {{--                        <td>{{$teklif->malzemeFiyati}}</td>--}}
{{--                            <td>{{number_format((($teklif->miktar)*($teklif->malzemeFiyati)),2)}} $</td>--}}
                        </tr>
                    @endforeach

                    <tr>
                        <td>Anahtar Teslim Montaj ve Test</td>
                        <td>1</td>
                        <td>adet</td>
{{--                        <td>{{number_format(($TeklifYapanKisi->iscilik) + ($TeklifYapanKisi->yol), 2)}} $</td>--}}
                    </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <hr>
    @php(number_format( $karliTutar = (($sub_total))+(($sub_total)*($TeklifYapanKisi->yuzdelikKar/100)),2) )
    @php(number_format($kdvTutar = $karliTutar * (18/100), 2))
    <div style="  position: absolute; right: 0px; width: 30%; ">
        <div class="col-sm-12">


            <div class="table-responsive">

                <table class="table">
                    <strong><p class="lead">Miktar</p></strong>
                    <tbody>

                    <tr>
                        <th>KDV</th>
                        <td>%18</td>
                    </tr>

                    <tr>
                        <th>Toplam:</th>
                        <td>{{ number_format(($karliTutar + $kdvTutar), 2) }} $</td>
                    </tr>
                    </tbody>
                </table>
            </div>


        </div>
    </div>


</section>


</body>
</html>



