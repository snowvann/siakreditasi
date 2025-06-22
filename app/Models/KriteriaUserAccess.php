<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KriteriaUserAccess extends Model
{

        protected $table = 'kriteria_user_access';
        
        protected $fillable = [
        'kriteria_id',
        'user_id',
        'baca',
        'tulis',
        'validasi'
    ];

    // Relasi ke User
    public function user() {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Kriteria
    public function kriteria() {
        return $this->belongsTo(Kriteria::class);
    }
}
