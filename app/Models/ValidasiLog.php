<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ValidasiLog extends Model
{
    use HasFactory;

    protected $table = 'validasi_log';

    protected $fillable = [
        'kriteria_id',
        'validasi_kriteria_id',
        'user_id',
        'level_validator',
        'status',
        'komentar',
    ];

    public function validasiKriteria()
    {
        return $this->belongsTo(ValidasiKriteria::class);
    }

    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class, 'kriteria_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function komentarValidasi()
    {
        return $this->hasMany(KomentarValidasi::class);
    }
}
