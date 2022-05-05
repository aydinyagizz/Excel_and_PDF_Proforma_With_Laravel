@extends('layouts.adminLayout')

@section('title')
@endsection

@section('css')

@endsection

@section('content')

    <div class="col-md-6">
    <br>
{{--    <a href="{{ route('admin.export') }}" class="btn btn-primary">Excel oluştur</a>--}}
    <br>
        <hr>
    <form action="{{ route('admin.import') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="import_file"><br>
        <input type="submit" class="btn btn-primary" value="Değişiklikleri içe aktar">


    </form>
        <br>
    </div>
<table class="table">
    <thead>
    <tr>
        <th>Sipariş ve Özellik</th>
        <th>Miktar</th>
        <th>Birim</th>
        <th>Malzeme Fiyatı</th>
        <th>Toplam Tutar</th>
        <th>CreateAt</th>
    </tr>
    </thead>
    <tbody>
    @forelse($teklif as $teklif)
        <tr>
            <td>{{$teklif->siparisOzellik}}</td>
            <td>{{$teklif->miktar}}</td>
            <td>{{$teklif->birim}}</td>
            <td>{{$teklif->malzemeFiyati}}</td>
            <td>{{number_format(($teklif->miktar) * ($teklif->malzemeFiyati), 2)}}</td>
            <td>{{$teklif->created_at}}</td>

        </tr>

    @empty
    <tr>
        <td colspan="3" class="text-center">Data yok</td>
    </tr>
    @endforelse
    </tbody>
</table>


@endsection

@section('js')

    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        } );
    </script>
@endsection
