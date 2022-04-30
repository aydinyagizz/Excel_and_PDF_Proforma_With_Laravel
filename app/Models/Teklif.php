<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Teklif extends Model
{
    use HasFactory;

    protected $table = 'posts';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id', 'fatura_id', 'siparisOzellik', 'miktar', 'birim', 'malzemeFiyati', 'created_at'
    ];

    public function GetAll(){
         DB::table('posts')->get();
    }
}
