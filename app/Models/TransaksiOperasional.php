<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TransaksiOperasional extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'transaksi_operasional';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'admin_id',
        'tipe',
        'keterangan',
        'jumlah',
        'tanggal'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'tanggal' => 'datetime',
        'jumlah' => 'decimal:2'
    ];

    /**
     * Get the admin who created the transaction.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function admin(): BelongsTo
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    /**
     * Scope for income transactions.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePemasukan($query)
    {
        return $query->where('tipe', 'pemasukan');
    }

    /**
     * Scope for expense transactions.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePengeluaran($query)
    {
        return $query->where('tipe', 'pengeluaran');
    }

    /**
     * Format the jumlah attribute with currency.
     *
     * @return string
     */
    public function getFormattedJumlahAttribute()
    {
        return 'Rp' . number_format($this->jumlah, 0, ',', '.');
    }

    /**
     * Format the tanggal attribute.
     *
     * @return string
     */
    public function getFormattedTanggalAttribute()
    {
        return $this->tanggal->format('d M Y');
    }
}
