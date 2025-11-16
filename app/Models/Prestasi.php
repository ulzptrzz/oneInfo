<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prestasi extends Model
{
    protected $table = 'prestasi';
    protected $fillable = [
        'tanggal',
        'deskripsi',
        'siswa_id',
        'program_id',
        'dokumentasi_id',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
    public function program()
    {
        return $this->belongsTo(Program::class);
    }
    public function dokumentasi()
    {
        return $this->belongsTo(Dokumentasi::class);
    }
}
