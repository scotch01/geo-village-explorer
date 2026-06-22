<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Tempat;
use App\Models\PmlPclAssignment;

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

        'role',
        'id_desa',
        'must_change_password',
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

    protected $casts = [

        'must_change_password'
            => 'boolean',

    ];

    public function desa()
    {
        return $this->belongsTo(Desa::class, 'id_desa');
    }

    const ROLE_MASTER_ADMIN = 'master_admin';
    const ROLE_PENGAWAS = 'pengawas';
    const ROLE_ADMIN_DESA = 'admin_desa';

    public function isMasterAdmin()
    {
        return $this->role === self::ROLE_MASTER_ADMIN;
    }

    public function isPengawas()
    {
        return $this->role === self::ROLE_PENGAWAS;
    }

    public function isAdminDesa()
    {
        return $this->role === self::ROLE_ADMIN_DESA;
    }

    public function assignedPcls()
    {
        return $this->belongsToMany(
            User::class,
            'pml_pcl_assignments',
            'pml_id',
            'pcl_id'
        );
    }

    public function assignedPmls()
    {
        return $this->belongsToMany(
            User::class,
            'pml_pcl_assignments',
            'pcl_id',
            'pml_id'
        );
    }

    public function canEditTempat(
        Tempat $tempat
    ): bool
    {
        if ($this->isMasterAdmin()) {
            return true;
        }

        if ($this->isAdminDesa()) {

            return
                $tempat->created_by
                ==
                $this->id;
        }

        if ($this->isPengawas()) {

            return
                PmlPclAssignment::query()
                    ->where(
                        'pml_id',
                        $this->id
                    )
                    ->where(
                        'pcl_id',
                        $tempat->created_by
                    )
                    ->exists();
        }

        return false;
    }

    public function canViewTempat(
        Tempat $tempat
    ): bool
    {
        if ($this->isMasterAdmin()) {
            return true;
        }

        return $tempat->id_desa === $this->id_desa;
    }
}
