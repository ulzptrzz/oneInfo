<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Perizinan extends Model
{
    protected $table = 'perizinan';
    protected $primaryKey = 'id';
    protected $fillable = [
        'pendaftaran_id',
        'user_id',
        'file',
        'status',
        'catatan',
        'tanggal_dikirim',
    ];

    public function pendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class, 'pendaftaran_id');
    }

    public function admin()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }
}
