<?php

namespace App\Exports;

use App\Models\Post;
use App\Models\Teklif;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Events\BeforeExport;

class PostExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
       // return Post::all();
        return Teklif::all();
    }

//    public function registerEvents(): array
//    {
//        return [
//            AfterSheet::class => function(AfterSheet $event){
//                $event->sheet->setCellValue('E27', Post::all()[1]->title);
//            },
//        ];
//    }
}
