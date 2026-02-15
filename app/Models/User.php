<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{

    protected $fillable = [
        'name',
        'email',
        'password',
        'id_role'
    ];

    public function hasRole($roles)
    {
        if (is_array($roles)) {
            return in_array($this->role?->nama_role, $roles);
        }

        return $this->role?->nama_role === $roles;
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'id_role', 'id_role');
    }


    public function isSuperAdmin()
    {
        return $this->role->nama_role === 'Super Admin';
    }

    public function isAdmin()
    {
        return $this->role->nama_role === 'Admin';
    }

    public function isManajer()
    {
        return $this->role->nama_role === 'Manajer Toko';
    }

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
