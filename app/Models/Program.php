<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    protected $table = 'program';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nama_program',
        'deskripsi',
        'tanggal_mulai',
        'tanggal_selesai',
        'status',
        'poster',
        'penyelenggara',
        'tingkat',
        'mata_lomba',
        'user_id',
        'kategori_program_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
    public function kategoriProgram()
    {
        return $this->belongsTo(KategoriProgram::class, 'kategori_program_id', 'id');
    }
}
