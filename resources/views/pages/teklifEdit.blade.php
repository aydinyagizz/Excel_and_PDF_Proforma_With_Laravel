@extends('layouts.adminLayout')

@section('title')
@endsection

@section('css')
@endsection

@section('content')

    <div class="box box-primary" style="position: relative; left: 0px; top: 0px;">
        <div class="box-header ui-sortable-handle">
{{--            <i class="ion ion-clipboard"></i>--}}

{{--            <h3 class="box-title">Teklif Düzenle</h3>--}}

            <section class="content-header">
                <i class="ion ion-clipboard fa-2x"></i>
                <h3 class="box-title"> Teklif Düzenle</h3>

                <ol class="breadcrumb">
                    <li><a href="{{route('admin.index')}}"></i> Anasayfa</a></li>
{{--                    <li><a href="{{Illuminate\Support\Facades\URL::previous() }}"></i> Teklif Ekle</a></li>--}}
                    <li><a href="{{ url('teklifEkle/'.$data['teklifEdit']->fatura_id) }}"></i> Teklif Ekle</a></li>
                    <li class="active">Teklif Düzenle</li>
                </ol>

            </section>

        </div>
        <div class="box-body">
            <form action="{{route('admin.teklifEdit')}} " method="POST">
                @csrf

                <input type="hidden" name="id" value="{{$data['teklifEdit']->id}}">

            <div class="box-footer clearfix no-border form-group">
{{--                <div>--}}
{{--                <label class="text" for="siparisOzellik">Sipariş ve özellikler</label>--}}
{{--                <input type="text" name="siparisOzellik" class="form-control" placeholder="Sipariş ve özellikler" required value="{{$data['teklifEdit']->siparisOzellik}}">--}}
{{--                </div>--}}
                <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Ürün Adı</label>
                        <select class="form-control select2 selectDiv1"
                                data-placeholder="Ürün Seçiniz" style="width: 100%;" tabindex="-1"
                                aria-hidden="true" name="siparisOzellik" id="siparisOzellik" required>
                            <option selected>{{$data['teklifEdit']->siparisOzellik}}</option>
                            @foreach($data['urun'] as $urunler)
                                <option id="option2" class="test"
                                        value="{{$urunler->id}}">{{$urunler->siparisOzellik}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>



                    <div class="col-md-4">
                    <label class="text" for="miktar">Miktar</label>
                    <input type="number" name="miktar" id="miktar" class="form-control" placeholder="Miktar" required value="{{$data['teklifEdit']->miktar}}">
                    </div>

                    <div class="col-md-4">
                        <label class="text" for="birim">Birim</label>
                        <input type="text" name="birim" id="birim" class="form-control" placeholder="Birim" required value="{{$data['teklifEdit']->birim}}">
                    </div>

                    <div class="col-md-4">
                        <label class="text" for="malzemeFiyati">Malzeme Fiyatı</label>
                        <input type="number" name="malzemeFiyati" id="malzemeFiyati" class="form-control" placeholder="Malzeme Fiyatı" required value="{{$data['teklifEdit']->malzemeFiyati}}">
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
                    headers: {'X-CSRF-TOKEN':'{{csrf_token()}}'},
                    url: '{{route('admin.faturaDetayGetir')}}',
                    type: 'POST',
                    data: { id: urun },
                    success:function(data){
                        if ($.trim(data) != '') {
                            $('#miktar').val(data.urunDetay.miktar);
                            $('#birim').val(data.urunDetay.birim);
                            $('#malzemeFiyati').val(data.urunDetay.malzemeFiyati);
                        }
                        else{
                            alert("İlgili Kaydın verisi bulunamadı.");
                        }
                    }

                })

            });
        });
    </script>

@endsection
