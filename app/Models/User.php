<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function desa()
    {
        return $this->belongsTo(Desa::class, 'id_desa');
    }

    const ROLE_MASTER_ADMIN = 'master_admin';
    const ROLE_ADMIN_DESA = 'admin_desa';

    public function isMasterAdmin()
    {
        return $this->role === self::ROLE_MASTER_ADMIN;
    }

    public function isAdminDesa()
    {
        return $this->role === self::ROLE_ADMIN_DESA;
    }
}
