<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Isian extends Model
{
    use HasFactory;

    protected $table = 't_isian';  // Nama tabel di database

    protected $fillable = [
        'akreditasi_id',
        'subkriteria_id',
        'nilai',
        'user_id',

    ];

    
    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Akreditasi
    public function akreditasi()
    {
        return $this->belongsTo(Akreditasi::class);
    }

    // Relasi ke Subkriteria
    public function subkriteria()
    {
        return $this->belongsTo(Subkriteria::class);
    }
}
