<?php

namespace App\Http\Controllers;
//use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Fatura;
use App\Models\Post;
use App\Models\Teklif;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Calculation\MathTrig\Sum;
use SebastianBergmann\CodeUnit\Mapper;
use function GuzzleHttp\Promise\all;
use PDF;

class TeklifController extends Controller
{
    public function teklifListele()
    {
        return view('pages.teklifListele');
    }

    public function teklifEkle($id, Request $request)
    {
        $ide = $id;
        if ($request->post()) {

            $teklif = new Teklif();
            $faturalar = Fatura::all();
            $teklifler = Teklif::all();
            $teklif->fatura_id = $ide;
            $teklif->siparisOzellik = $request->siparisOzellik;
            $teklif->fatura_id = $request->id;

            $teklif->miktar = $request->miktar;
            $teklif->birim = $request->birim;
            $teklif->malzemeFiyati = $request->malzemeFiyati;

            $teklif->save();

            //return redirect()->route('admin.teklifEkle/'.$id);
            return redirect()->back();
        }

        $data = [
            'teklif' => Teklif::all()->where('fatura_id', '==', $id),
            'Id' => $id,
            'TeklifYapanKisi' => Fatura::all()->where('id', '==', $id)->first(),
        ];

        return view('pages.teklifEkle', $data);
    }


    public function teklifDelete($id)
    {
        $teklifDelete = Teklif::find($id);
        $teklifDelete->delete();
        return redirect()->back();
    }

    public function teklifEdit($id, Request $request)
    {
        $data = [
            'teklifEdit' => Teklif::find($id),


        ];
        return view('pages.teklifEdit', compact('data'));
    }

    public function teklifUpdate(Request $request)
    {
        $teklifUpdate = Teklif::find($request->id);

        $teklifUpdate->siparisOzellik = $request->siparisOzellik;
        $teklifUpdate->miktar = $request->miktar;
        $teklifUpdate->birim = $request->birim;
        $teklifUpdate->malzemeFiyati = $request->malzemeFiyati;
        $teklifUpdate->save();
        return redirect('teklifEkle/' . $teklifUpdate->fatura_id);

    }

    public function teklifPdf($id)
    {
        $data = [
            'teklif' => Teklif::all()->where('fatura_id', '==', $id),
            'Id' => $id,
            'TeklifYapanKisi' => Fatura::all()->where('id', '==', $id)->first(),

        ];

        return view('pages.teklifPdf', $data);
    }

    public function pdfDownload($Id)
    {
        $data = [
            //'teklif' => DB::table("posts")->get()->where('id', $Id),
            'teklif' => Teklif::all()->where('fatura_id', '==', $Id),
            'Id' => $Id,
            'TeklifYapanKisi' => Fatura::find($Id),
        ];

        $pdf = PDF::loadView('pages.pdfGenerator', $data);
        return $pdf->download($data['TeklifYapanKisi']->musteriAdSoyad . $data['TeklifYapanKisi']->faturaNo.'.pdf');

    }


}
