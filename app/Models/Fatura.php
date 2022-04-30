<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fatura extends Model
{
    use HasFactory;
    protected $table = 'faturalar';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id', 'teklif_id', 'musteriAdSoyad', 'faturaNo', 'yuzdelikKar', 'iscilik', 'yol', 'created_at'
    ];
}
