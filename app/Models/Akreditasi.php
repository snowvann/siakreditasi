<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Akreditasi extends Model
{
    use HasFactory;

    protected $table = 'akreditasi';

    protected $fillable = [
        'user_id',
        'judul',
        'deskripsi',
        'status'
    ];

    // Relasi dengan user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi dengan validasi kriteria
    public function validasiKriteria()
    {
        return $this->hasMany(ValidasiKriteria::class);
    }

    // Relasi dengan file uploads
    public function fileUploads()
    {
        return $this->hasMany(FileUpload::class);
    }
}