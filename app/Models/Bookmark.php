<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    protected $fillable = [ 
        'user_id',
        'program_id',
    ];

    public function program() {
        return $this->belongsTo(Program::class);
    }
}
