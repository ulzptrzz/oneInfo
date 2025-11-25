<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Artikel extends Model
{
    // Nama tabel yang digunakan model ini
    protected $table = 'artikel';

    // Field yang boleh diisi
    protected $fillable = [
        'judul',      
        'deskripsi',  
        'status',     
        'tanggal',    
        'thumbnail',  
    ];
}
