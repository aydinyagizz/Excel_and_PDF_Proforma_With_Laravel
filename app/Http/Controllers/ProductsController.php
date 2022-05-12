<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function urunEkle(Request $request)
    {

        if ($request->post()) {

            $urun = new Products();

            $urun->siparisOzellik = $request->siparisOzellik;

            $urun->miktar = $request->miktar;
            $urun->birim = $request->birim;
            $urun->malzemeFiyati = $request->malzemeFiyati;
            $urun->urunKar = $request->urunKar;

            $urun->save();

            //return redirect()->route('admin.teklifEkle/'.$id);
            return redirect()->back();
        }

        $data = [
            'urunler' => Products::all(),
            'urun' => Products::orderBy('id', 'desc')->paginate(10),
        ];

        return view('pages.urunEkle', $data);
    }

    public function urunDelete($id)
    {
        $urunDelete = Products::find($id);
        $urunDelete->delete();
        return redirect()->back();
    }

    public function urunEdit($id, Request $request)
    {
        $data = [
            'urunEdit' => Products::find($id),


        ];
        return view('pages.urunEdit', compact('data'));
    }

    public function urunUpdate(Request $request)
    {
        $urunUpdate = Products::find($request->id);

        $urunUpdate->siparisOzellik = $request->siparisOzellik;
        $urunUpdate->miktar = $request->miktar;
        $urunUpdate->birim = $request->birim;
        $urunUpdate->malzemeFiyati = $request->malzemeFiyati;
        $urunUpdate->urunKar = $request->urunKar;
        $urunUpdate->save();
        return redirect('urunEkle');

    }

    public function productsSearch(Request $request)
    {
        $articles = Products::when($request->has("title"),function($q)use($request){
            return $q->where("title","like","%".$request->get("title")."%");
        })->paginate(5);
        if($request->ajax()){
            return view('articles.article-pagination ',['articles'=>$articles]);
        }
        return view('articles.article ',['articles'=>$articles]);
    }
}
