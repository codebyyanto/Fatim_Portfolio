<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;

    protected $table = 'tbkeahlian_23312241';
    
    protected $fillable = [
        'nama_keahlian',
        'kategori_23312241',
        'deskripsi',
        'icon',
        'status',
    ];
}
