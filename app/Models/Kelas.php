<?php

namespace App\Models;

use App\Models\Jurusan;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = "kelas";

    protected $fillable = [
        'nama_kelas',
        'jurusan_id',
        'tingkat',
        'tahun_ajaran'
    ];

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'jurusan_id');
    }
}
