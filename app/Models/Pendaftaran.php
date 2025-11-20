<?php

namespace App\Models;

use App\Models\Siswa;
use App\Models\Program;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    protected $table = 'pendaftaran';

    protected $fillable = [
        'tanggal_daftar',
        'status',
        'siswa_id',
        'program_id',
        'bukti_pendaftaran',
        'syarat_pendaftaran'
    ];

    public function siswa(){
        return $this->belongsTo(Siswa::class);
    }

    public function program(){
        return $this->belongsTo(Program::class);
    }
}
