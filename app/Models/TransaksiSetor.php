<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiSetor extends Model
{
    use HasFactory;

    protected $table = 'transaksi_setor';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'sampah_id',
        'berat',
        'total_harga',
        'status',
        'bukti_foto',
        'tanggal_setor'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'tanggal_setor' => 'datetime',
        'berat' => 'decimal:2',
        'total_harga' => 'decimal:2'
    ];

    /**
     * Get the user that made the transaction.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the waste type for the transaction.
     */
    public function sampah()
    {
        return $this->belongsTo(Sampah::class);
    }
}
