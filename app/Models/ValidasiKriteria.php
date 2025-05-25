<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ValidasiKriteria extends Model
{
    use HasFactory;

    protected $table = 'validasi_kriteria';

    protected $fillable = [
        'akreditasi_id',
        'kriteria_id',
        'status',
        'catatan'
    ];

    // Relasi dengan akreditasi
    public function akreditasi()
    {
        return $this->belongsTo(Akreditasi::class);
    }

    // Relasi dengan kriteria
    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class);
    }

    // Relasi dengan validasi log
    public function validasiLog()
    {
        return $this->hasMany(ValidasiLog::class);
    }

    // Relasi dengan komentar validasi
    public function komentarValidasi()
    {
        return $this->hasMany(KomentarValidasi::class);
    }
}