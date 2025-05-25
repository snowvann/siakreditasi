<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ValidasiLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'validasi_kriteria_id',
        'user_id',
        'catatan'
    ];

    // Relasi dengan validasi kriteria
    public function validasiKriteria()
    {
        return $this->belongsTo(ValidasiKriteria::class);
    }

    // Relasi dengan user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}