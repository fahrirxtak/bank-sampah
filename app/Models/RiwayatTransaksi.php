<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatTransaksi extends Model
{
    protected $table = 'riwayat_transaksi';
    protected $fillable = ['user_id', 'tanggal', 'tipe', 'kategori', 'keterangan', 'jumlah'];
}
