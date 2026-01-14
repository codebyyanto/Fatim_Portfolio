<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $table = 'tbproyek_23312241';

    protected $fillable = [
        'nama_proyek',
        'tahun_proyek',
        'jenis_proyek',
        'tim_pengembang',
        'deskripsi',
        'durasi',
        'gambar',
        'video_demo',
        'status',
    ];
}
