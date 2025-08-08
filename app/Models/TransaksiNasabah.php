<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransaksiNasabah extends Model
{
    protected $table = 'transaksi_nasabah';
    protected $fillable = [
        'nasabah_id',
        'tipe',
        'keterangan',
        'jumlah',
        'status'
    ];

    public function nasabah()
    {
        return $this->belongsTo(User::class, 'nasabah_id');
    }

    protected $dates = ['created_at', 'updated_at'];
}
