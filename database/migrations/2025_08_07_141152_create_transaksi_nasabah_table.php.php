<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transaksi_nasabah', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nasabah_id')->constrained('users')->onDelete('cascade');
            $table->enum('tipe', ['pemasukan', 'pengeluaran']);
            $table->string('keterangan');
            $table->decimal('jumlah', 12, 2);
            $table->enum('status', ['pending', 'selesai', 'ditolak'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
