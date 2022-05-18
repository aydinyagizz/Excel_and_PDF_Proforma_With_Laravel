<?php

namespace App\Http\Controllers;

use App\Exports\PostExport;
use App\Imports\PostImport;
use App\Models\Fatura;
use App\Models\Post;
use App\Models\Products;
use App\Models\Teklif;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Validator;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Exception;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Component\Console\Input\Input;

class IndexController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index(Request $request)
    {
        //TODO: buraya kullanıcı, fatura sayısı ve ürün sayıları gibi şeyler gelecek.
        $data = [
            'fatura' => Fatura::all(),
            'urun' => Products::all(),
            'user' => User::all()
        ];
        return view('pages.index', $data);
    }

    public function home(Request $request)
    {
        //$posts = Post::all();
        $teklif = Teklif::all();
        return view('pages.home', compact('teklif'));
    }
//    public function import(Request $request) {
//        $posts = Excel::toCollection(new PostImport(), $request->file('import_file'));
//        foreach ($posts[0] as $post){
//
//           Post::where('id', $post[0])->update([
//               'title' => $post[1],
//               'description' => $post[2],
//           ]);
//        }
//        return \redirect()->route('admin.home');
//    }

    public function import(Request $request)
    {

        if ($request->import_file == '') {
            return Redirect::to('urunEkle')->withErrors('Dosya Seçiniz.');
        }

        $this->validate($request, [
            'import_file' => 'required|file|mimes:xls,xlsx'
        ]);

        $icerikler = Excel::toCollection(new PostImport(), $request->file('import_file'));
        foreach ($icerikler[0] as $icerik){

            if ($icerik[0] == '' || $icerik[1] == '' || $icerik[2] == '') {
                return Redirect::to('urunEkle')->withErrors('Hata! İçeriklerde boş alan bulunamaz');
            }
        };



//        $icerikler = Excel::toCollection(new PostImport(), $request->file('import_file'));
//
//        foreach ($icerikler as $icerik){
//
//                echo '<pre>';
//                //dd($icerik[14][3]);
//                //dd($icerik[16][6]);
//                dd($icerik[136]);
//                echo '<pre>';
//
//
//
//            //if ($icerik[0] == '' || $icerik[1] == '' || $icerik[2] == '') {
//               // return Redirect::to('urunEkle')->withErrors('Hata! İçeriklerde boş alan bulunamaz');
//            //}
//
//        };
//die();

        $the_file = $request->file('import_file');
        try {
            $spreadsheet = IOFactory::load($the_file->getRealPath());
            $sheet = $spreadsheet->getActiveSheet();
            $row_limit = $sheet->getHighestDataRow();
            $column_limit = $sheet->getHighestDataColumn();
            $row_range = range($request->baslangicSatir, $row_limit);
            $column_range = range('F', $column_limit);
            $startcount = 1;
            $data = array();

            //$row_range kaçıncı satırdan itibaren veriler alınacak

            foreach ($row_range as $row) {

//                $data[] = [
//                    'siparisOzellik' =>$sheet->getCell( $request->urunSatir . $row )->getValue() ?? 'Ürün',
//                    'miktar' => $sheet->getCell( $request->miktarSatir . $row )->getValue() ?? 0,
////                    'birim' => $sheet->getCell( $request->birimSatir . $row )->getValue() ?? 'Adet',
//                    'birim' => 'adet',
//                    'malzemeFiyati' => $sheet->getCell( $request->malzemeFiyatSatir . $row )->getValue() ?? 0,
//                    'urunKar' => $request->urunKar
//                ];


//                echo '<pre>';
//               print_r($siparisOzellik);
//                echo '<pre>';

                $data[] = [
                    'siparisOzellik' => $sheet->getCell($request->urunSutun . $row)->getValue(),
                    //'miktar' => $sheet->getCell($request->miktarSutun . $row)->getValue(),
                    'miktar' => 1,
//                    'birim' => $sheet->getCell( $request->birimSutun . $row )->getValue() ?? 'adet',
                    'birim' => 'adet',
                    'malzemeFiyati' => $sheet->getCell($request->malzemeFiyatSutun . $row)->getOldCalculatedValue() ?? $sheet->getCell($request->malzemeFiyatSutun . $row)->getValue(),
                    'urunKar' => $request->urunKar
                ];
            }


//            for ($i=0; $i< count($data); $i++ ) {
////                if (is_numeric($data[$i]['malzemeFiyati'])){
////                    print_r('saısal değil');
////                }
////              die();
////                echo '<pre>';
////                //print_r($data[$i]['malzemeFiyati']);
////                print_r($data[$i]['malzemeFiyati']);
////                echo '<pre>';
//                echo '<pre>';
//                print_r($data[$i]['malzemeFiyati'] == 0);
//                echo '<pre>';
//            }
//            die();

            $startcount++;

            DB::table('products')->insert($data);


        } catch (Exception $e) {
            $error_code = $e->errorInfo[1];
            return Redirect::to('urunEkle')->withErrors('Hata! Yanlış giden bir şeyler var. Lütfen tekrar deneyin.');
        }

        return Redirect::to('urunEkle')->withSuccess('Ürünler Kaydedildi.');
    }


    public function export($id, Request $request)
    {
        if(session()->has('karOrani')){
            $karOrani =  Session::get('karOrani',);
        }
        if(session()->has('karliUrunTutar')){
            $karliUrunTutar =  Session::get('karliUrunTutar');
        }

//        Excel::store(new PostExport(), 'dgh.xls');
//        return Excel::download(new PostExport(), 'dgh.xls');

        //okuma işlemi
        $reader = IOFactory::createReader('Xls');
        $spreadSheet = $reader->load(storage_path() . '/app/dgh.xls');

        //$spreadSheet->getActiveSheet()->getCell('H19')->setValue(Teklif::all()[1]->miktar);
        //$spreadSheet->getActiveSheet()->getCell('C19')->setValue(Teklif::all()[1]->siparisOzellik);
        //$spreadSheet->getActiveSheet()->getCell('H19')->setValue("aydın");

//        $teklifler = Teklif::all()->where('fatura_id','==',$id)->get();


        $teklifler = DB::table('posts')->get()->where('fatura_id', '==', $id);
        $faturaName = Fatura::all()->where('id', '==', $id)->first();

        $result = (array)json_decode($teklifler, true);

        $rowCount = count($teklifler);
        $excelBaslangic = 17;
        $spreadSheet->getActiveSheet()->getCell('D9')->setValue($faturaName['musteriAdSoyad']);
        $say = 0;
        foreach ($result as $key) {
            if(session()->has('karliUrunTutar')){
                $karliUrunTutar =  Session::get('karliUrunTutar');
            }
            $spreadSheet->getActiveSheet()->getCell('C' . $excelBaslangic)->setValue($key['siparisOzellik']);
            $spreadSheet->getActiveSheet()->getCell('E' . $excelBaslangic)->setValue($key['miktar']);
            $spreadSheet->getActiveSheet()->getCell('F' . $excelBaslangic)->setValue($key['birim']);
            $spreadSheet->getActiveSheet()->getCell('G' . $excelBaslangic)->setValue((($key['miktar']) * ($key['malzemeFiyati']) + (($key['miktar']) * ($key['malzemeFiyati'])) * $karOrani/100));
            $spreadSheet->getActiveSheet()->getCell('H' . $excelBaslangic)->setValue((($key['miktar']) * ($key['malzemeFiyati']) + (($key['miktar']) * ($key['malzemeFiyati'])) * $karOrani/100) );
            $excelBaslangic++;
            $say++;

        }

        $spreadSheet->getActiveSheet()->getCell('C' . $excelBaslangic)->setValue('İşçilik');
        $spreadSheet->getActiveSheet()->getCell('E' . $excelBaslangic)->setValue('');
        $spreadSheet->getActiveSheet()->getCell('F' . $excelBaslangic)->setValue('');
        $spreadSheet->getActiveSheet()->getCell('G' . $excelBaslangic)->setValue($faturaName->iscilik);
        $spreadSheet->getActiveSheet()->getCell('H' . $excelBaslangic)->setValue($faturaName->iscilik);

        $spreadSheet->getActiveSheet()->getCell('C' . $excelBaslangic + 1)->setValue('Yol');
        $spreadSheet->getActiveSheet()->getCell('E' . $excelBaslangic + 1)->setValue('');
        $spreadSheet->getActiveSheet()->getCell('F' . $excelBaslangic + 1)->setValue('');
        $spreadSheet->getActiveSheet()->getCell('G' . $excelBaslangic + 1)->setValue($faturaName->yol);
        $spreadSheet->getActiveSheet()->getCell('H' . $excelBaslangic + 1)->setValue($faturaName->yol);

//        for($i=18;$i<18+$rowCount;$i++) {
//
//            $spreadSheet->getActiveSheet()->getCell('C' . $i)->setValue($result[$i-18]['siparisOzellik']);
//            $spreadSheet->getActiveSheet()->getCell('E' . $i)->setValue($result[$i-18]['miktar']);
//            $spreadSheet->getActiveSheet()->getCell('F' . $i)->setValue($result[$i-18]['birim']);
//            $spreadSheet->getActiveSheet()->getCell('G' . $i)->setValue($result[$i-18]['malzemeFiyati']);
//            $spreadSheet->getActiveSheet()->getCell('H' . $i)->setValue(($result[$i-18]['miktar'])*($result[$i-18]['malzemeFiyati']));
//
//        }


        //üzerine yazılan dosyayı kaydetme
        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadSheet, "Xls");
        //$writer->save(storage_path() . '/app/dgh.xls');


        $response = response()->streamDownload(function () use ($spreadSheet) {
            $writer = new Xlsx($spreadSheet);
            $writer->save('php://output');
        });
        $response->setStatusCode(200);
        $response->headers->set('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

        // $faturaName = new Fatura();


        //TODO: Burayı ekledim. Aşağıyı yoruma aldım. Burası değişebilir.

        $response->headers->set('Content-Disposition', "attachment; filename=$faturaName->musteriAdSoyad $faturaName->faturaNo.xls");


        //$response->headers->set('Content-Disposition', 'attachment; filename="dgh.xls"');
        $response->send();

    }

//    public function storage() {
//        return Excel::store(new PostExport(), 'dgh11.xlsx');
//    }


//    public function import(Request $request) {
//        $posts = Excel::toCollection(new PostImport(), $request->file('import_file'));
//        foreach ($posts[0] as $post){
//
//           Post::where('id', $post[0])->update([
//               'title' => $post[1],
//               'description' => $post[2],
//           ]);
//        }
//        return \redirect()->route('admin.home');
//    }


//    public function import(Request $request){
//
//        if ($request->import_file == ''){
//            return Redirect::to('urunEkle')->withErrors('Dosya Seçiniz.');
//        }
//
//        $posts = Excel::toCollection(new PostImport(), $request->file('import_file'));
//        foreach ($posts[0] as $post){
//
//            if ($post[0] == '' || $post[1] == '' || $post[2] == '') {
//                return Redirect::to('urunEkle')->withErrors('Hata! İçeriklerde boş alan bulunamaz');
//            }
//        };
//
//        $this->validate($request, [
//            'import_file' => 'required|file|mimes:xls,xlsx'
//        ]);
//
//        $the_file = $request->file('import_file');
//        try{
//            $spreadsheet = IOFactory::load($the_file->getRealPath());
//            $sheet        = $spreadsheet->getActiveSheet();
//            $row_limit    = $sheet->getHighestDataRow();
//            $column_limit = $sheet->getHighestDataColumn();
//            $row_range    = range( 1, $row_limit );
//            $column_range = range( 'F', $column_limit );
//            $startcount = 1;
//            $data = array();
//
//            //$row_range kaçıncı satırdan itibaren veriler alınacak
//
//            foreach ( $row_range as $row ) {
//                $data[] = [
//                    'siparisOzellik' =>$sheet->getCell( 'C' . $row )->getValue(),
//                    'miktar' => $sheet->getCell( 'A' . $row )->getValue(),
//                    'birim' => $sheet->getCell( 'B' . $row )->getValue(),
//                    'malzemeFiyati' => $sheet->getCell( 'A' . $row )->getValue(),
//                ];
//            }
//            $startcount++;
//
//            DB::table('products')->insert($data);
//
//        } catch (Exception $e) {
//            $error_code = $e->errorInfo[1];
//            return Redirect::to('urunEkle')->withErrors('Hata! Yanlış giden bir şeyler var. Lütfen tekrar deneyin.');
//        }
//        return Redirect::to('urunEkle')->withSuccess('Ürünler Kaydedildi.');
//    }

}
