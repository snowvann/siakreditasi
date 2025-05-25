<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileUpload extends Model
{
    use HasFactory;

    protected $fillable = [
        'akreditasi_id',
        'nama_file',
        'path'
    ];

    // Relasi dengan akreditasi
    public function akreditasi()
    {
        return $this->belongsTo(Akreditasi::class);
    }
}