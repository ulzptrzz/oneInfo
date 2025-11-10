<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Perizinan extends Model
{
    protected $table = 'perizinan';
    protected $primaryKey = 'perizinan_id';
    protected $fillable = [
        'file',
        'status',
        'tanggal_konfirmasi',
        'pendaftaran_id'
    ];

    public function pendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class, 'pendaftaran_id', 'pendaftaran_id');
    }
}
