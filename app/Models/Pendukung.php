<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendukung extends Model
{
    use HasFactory;
    protected $table = "pendukung"; //cek
    protected $fillable = [
        'id',
        'id_item',
        'id_user',
        'id_opd',
        'label_file',
        'file',
    ];
}
