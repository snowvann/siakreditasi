<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengaturanSistem extends Model
{
    use HasFactory;

    protected $table = 'pengaturan_sistem';

    protected $fillable = [
        'key',
        'value'
    ];

    protected $primaryKey = 'key';
    public $incrementing = false;
    protected $keyType = 'string';
}