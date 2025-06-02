<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subkriteria extends Model
{
    use HasFactory;

    protected $table = 'subkriteria';

    protected $fillable = [
        'kriteria_id',
        'nama_subkriteria',
        'deskripsi'
    ];

    // Relasi dengan kriteria
    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class);
    }

        public function isian()
    {
        return $this->hasMany(Isian::class, 'subkriteria_id', 'id');
    }

}