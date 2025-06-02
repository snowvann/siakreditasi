<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class); // Ganti dengan nama model yang sesuai
    }
}