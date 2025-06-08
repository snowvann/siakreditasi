<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KomentarValidasi extends Model
{
    use HasFactory;

    protected $table = 'komentar_validasi'; // override nama tabel

    protected $fillable = [
        'validasi_kriteria_id',
        'user_id',
        'komentar'
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