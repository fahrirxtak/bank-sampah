<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransaksiTarik extends Model
{
    protected $table = 'transaksi_tarik';

        protected $fillable = [
        'user_id',
        'jumlah_tarik',
        'status',
        'status',
        'tanggal_tarik',
        'created_at',
        'updated_at'
    ];

    // App\Models\Penarikan.php
public function user()
{
    return $this->belongsTo(User::class);
}

}
