<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
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
        'saldo',
        'status',
        'alamat',
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

    protected static function boot()
    {
        parent::boot();

        // Set default values when creating new user
        static::creating(function ($user) {
            if (!isset($user->role)) {
                $user->role = 'nasabah';
            }
            if (!isset($user->status)) {
                $user->status = 'active';
            }
            if (!isset($user->saldo)) {
                $user->saldo = 0.00;
            }
        });
    }

    /**
     * Scope untuk filter nasabah saja
     */
    public function scopeNasabah($query)
    {
        return $query->where('role', 'nasabah');
    }

    /**
     * Scope untuk filter admin saja
     */
    public function scopeAdmin($query)
    {
        return $query->where('role', 'admin');
    }

    /**
     * Scope untuk filter user aktif
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope untuk filter user tidak aktif
     */
    public function scopeInactive($query)
    {
        return $query->where('status', 'inactive');
    }

    /**
     * Check if user is admin
     */
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    /**
     * Check if user is nasabah
     */
    public function isNasabah()
    {
        return $this->role === 'nasabah';
    }

    /**
     * Check if user is active
     */
    public function isActive()
    {
        return $this->status === 'active';
    }

    /**
     * Get formatted saldo
     */
    public function getFormattedSaldoAttribute()
    {
        return 'Rp ' . number_format($this->saldo, 0, ',', '.');
    }

    /**
     * Get saldo level (Tinggi, Sedang, Rendah)
     */
    public function getSaldoLevelAttribute()
    {
        if ($this->saldo >= 100000) {
            return [
                'level' => 'Tinggi',
                'class' => 'text-green-600',
                'bg_class' => 'bg-green-100',
                'icon' => 'fas fa-arrow-up'
            ];
        } elseif ($this->saldo >= 50000) {
            return [
                'level' => 'Sedang',
                'class' => 'text-yellow-600',
                'bg_class' => 'bg-yellow-100',
                'icon' => 'fas fa-minus'
            ];
        } else {
            return [
                'level' => 'Rendah',
                'class' => 'text-red-600',
                'bg_class' => 'bg-red-100',
                'icon' => 'fas fa-arrow-down'
            ];
        }
    }

    /**
     * Get user initials for avatar
     */
    public function getInitialsAttribute()
    {
        $words = explode(' ', $this->name);
        if (count($words) >= 2) {
            return strtoupper(substr($words[0], 0, 1) . substr($words[1], 0, 1));
        }
        return strtoupper(substr($this->name, 0, 2));
    }

    /**
     * Get status badge attributes
     */
    public function getStatusBadgeAttribute()
    {
        if ($this->status === 'active') {
            return [
                'text' => 'Aktif',
                'class' => 'bg-green-100 text-green-800 border-green-200',
                'icon' => 'fas fa-check-circle text-green-600'
            ];
        } else {
            return [
                'text' => 'Tidak Aktif',
                'class' => 'bg-red-100 text-red-800 border-red-200',
                'icon' => 'fas fa-times-circle text-red-600'
            ];
        }
    }

    /**
     * Get short address (max 50 characters)
     */
    public function getShortAddressAttribute()
    {
        if (!$this->alamat) {
            return 'Belum diisi';
        }

        if (strlen($this->alamat) > 50) {
            return substr($this->alamat, 0, 50) . '...';
        }

        return $this->alamat;
    }
}
