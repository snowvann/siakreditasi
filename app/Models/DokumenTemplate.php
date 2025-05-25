<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokumenTemplate extends Model
{
    use HasFactory;

    protected $table = 'dokumen_template';

    protected $fillable = [
        'kriteria_id',
        'nama_file',
        'path'
    ];

    // Relasi dengan kriteria
    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class);
    }
}