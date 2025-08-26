<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Kolom yang bisa diisi (mass assignment).
     */
    protected $fillable = [
        'name',
        'glr_dpn',
        'glr_blk',
        'username',
        'email',
        'password',
        'avatar',
        'kategori',
        'id_penjamin',
        'email_verified_at',
    ];

    /**
     * Kolom yang disembunyikan ketika di-serialize.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Kolom yang harus otomatis di-cast.
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'kategori' => 'integer',
        'id_penjamin' => 'integer',
    ];

    /**
     * Relasi contoh: jika id_penjamin merujuk ke tabel penjamin.
     */
    // public function penjamin()
    // {
    //     return $this->belongsTo(Penjamin::class, 'id_penjamin');
    // }
}
