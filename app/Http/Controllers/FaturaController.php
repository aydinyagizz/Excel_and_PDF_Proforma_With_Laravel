<?php

namespace App\Http\Controllers;

use App\Models\Fatura;
use App\Models\Post;
use App\Models\Products;
use App\Models\Teklif;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class FaturaController extends Controller
{
    public function faturaListele()
    {
//        $num_str = sprintf("%06d", mt_rand(1, 999999));
//        dd($num_str);

        $fatura = Fatura::orderBy('id', 'desc')->paginate(10);
        return view('pages.faturaListele', compact('fatura'));
    }

    public function faturaEkle(Request $request)
    {
        $data = [
            'fatura' => Fatura::orderBy('id', 'desc')->paginate(10),
            'urun' => Products::all(),
        ];
        //$paginate = DB::table('faturalar')->paginate();

        return view('pages.faturaEkle',$data);
    }

    public function faturaAdd(Request $request)
    {
//        dd($request);
        //TODO: burası düzenlenecek
//        foreach($request->request as $key) {
//            $aa = $request->input('siparisOzellik');
//            $aa = $request->miktar;
//
//        }
//        print_r($aa);
//        die();
////dd($request->request);
//        print_r(($request->miktar));
//        die();
//        dd($request->input()['siparisOzellik'.$i]);
//


        $randomSayi = $this->generateRegistrationId();

        $fatura = new Fatura();

        // $teklif = new Teklif();

        $fatura->musteriAdSoyad = $request->musteriAdSoyad;

//        $fatura->faturaNo = 'DGH-00'.count($faturaNoSay);
        $fatura->faturaNo = 'DGH-' . $randomSayi;

        $fatura->save();

//        foreach($request->request as $key) {
        for ($i=0; $i<count($request->siparisOzellik); $i++){

            echo $request->siparisOzellik[$i];
            $teklif = new Teklif();
            $teklif->siparisOzellik = $request->siparisOzellik[$i];

            $teklif->miktar = $request->miktar[$i];
            $teklif->fatura_id  = $fatura->id;
            $teklif->malzemeFiyati  = $request->malzemeFiyati[$i];
            $teklif->birim = $request->birim[$i];

            $teklif->save();

        }

//            $teklif = new Teklif();
//            $teklif->siparisOzellik = $request->input('siparisOzellik');
//
//            $teklif->miktar = $request->input('miktar');
//            $teklif->fatura_id  = $fatura->id;
//            $teklif->birim = $request->input('birim');
//
//            $teklif->save();


//          Teklif::create([
//               $teklif->siparisOzellik = $request->input('siparisOzellik'),
//               $teklif->miktar  => $request->input('miktar'),
//               $teklif->fatura_id  => $fatura->id,
//               $teklif->birim  => $request->input('birim'),
//            ]);

//        }
//        Teklif::insert();




        //return redirect()->route('admin.faturaEkle', compact('fatura'));
        return redirect('teklifEkle/' . $fatura->id);
    }

    function generateRegistrationId()
    {
        $id = mt_rand(1000, 9999); // better than rand()

        // call the same function if the id exists already
        if ($this->registrationIdExists($id)) {
            return $this->generateRegistrationId();
        }

        // otherwise, it's valid and can be used
        return $id;
    }

    function registrationIdExists($id)
    {
        // query the database and return a boolean
        // for instance, it might look like this in Laravel
        return Fatura::where('faturaNo', $id)->exists();
    }

    public function faturaDelete($id)
    {
        $faturaDelete = Fatura::find($id);
        $faturaDelete->delete();
        //return redirect()->route('admin.faturaEkle');
        return redirect()->back();
    }

    public function faturaEdit($id)
    {
        $faturaEdit = Fatura::find($id);

        return view('pages.faturaEdit', compact('faturaEdit'));
    }

    public function faturaUpdate(Request $request)
    {
        $faturaUpdate = Fatura::find($request->id);
        $faturaUpdate->musteriAdSoyad = $request->musteriAdSoyad;
        $faturaUpdate->save();
        return redirect()->route('admin.faturaEkle');

    }

    public function yuzdeEkle(Request $request, $id)
    {
        $yuzdeEkle = Fatura::find($request->id);

        //$fatura = new Fatura();
        // $teklif = Teklif::all();
        // $teklif = new Teklif();

        $yuzdeEkle->yuzdelikKar = $request->input('yuzdelikKar');
        $yuzdeEkle->iscilik = $request->input('iscilik');
        $yuzdeEkle->yol = $request->input('yol');

        $yuzdeEkle->save();
        return redirect('teklifEkle/' . $yuzdeEkle->id);
    }

}
