<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    protected $table = "transaksi"; //cek
    protected $fillable = [
        'id',
        'id_item',
        'id_user',
        'opd',
        'nilai_field1',
        'nilai_field2',
        'nilai_field3',
        'nilai_field4',
        'nilai_field5',
        'nilai_field6',
    ];

}
