<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    use HasFactory;

    protected $table = 'kriteria';

    protected $fillable = [
        'nama_kriteria',
        'deskripsi'
    ];

    // Relasi dengan subkriteria
    public function subkriteria()
    {
        return $this->hasMany(Subkriteria::class);
    }

    // Relasi dengan user (many-to-many)
    public function users()
    {
        return $this->belongsToMany(User::class, 'kriteria_user');
    }

    // Relasi dengan dokumen template
    public function dokumenTemplate()
    {
        return $this->hasMany(DokumenTemplate::class);
    }
}