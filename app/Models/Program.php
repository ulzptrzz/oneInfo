<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    protected $table = 'program';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'deskripsi',
        'tanggal_mulai',
        'tanggal_selesai',
        'status',
        'poster',
        'penyelenggara',
        'tingkat',
        'mata_lomba',
        'pelaksanaan',
        'link_pendaftaran',
        'panduan_lomba',
        'user_id',
        'kategori_program_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function kategoriProgram()
    {
        return $this->belongsTo(KategoriProgram::class, 'kategori_program_id');
    }

    public function bookmarkedBy()
    {
        return $this->belongsToMany(User::class, 'bookmarks');
    }
}
