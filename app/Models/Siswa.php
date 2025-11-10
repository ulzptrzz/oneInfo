<?php

namespace App\Models;

use App\Models\User;
use App\Models\Kelas;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'siswa';
    protected $fillable = [
        'name',
        'nis',
        'nisn',
        'foto',
        'kelas_id',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }
}