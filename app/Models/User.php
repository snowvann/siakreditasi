<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'username',
        'password',
        'role',
        'is_active',
        'last_login_at'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'last_login_at' => 'datetime',
    ];

    // Relasi dengan akreditasi
    public function akreditasi()
    {
        return $this->hasMany(Akreditasi::class);
    }

    // Relasi dengan kriteria (many-to-many)
    public function kriteria()
    {
        return $this->belongsToMany(Kriteria::class, 'kriteria_user');
    }

    // Relasi dengan notifikasi
    public function notifikasi()
    {
        return $this->hasMany(Notifikasi::class);
    }

    // Relasi dengan audit logs
    public function auditLogs()
    {
        return $this->hasMany(AuditLog::class);
    }
}