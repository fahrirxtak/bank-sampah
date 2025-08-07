<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // database/migrations/xxxx_xx_xx_create_transaksi_operasional_table.php
    public function up(): void
    {
        Schema::create('transaksi_operasional', function (Blueprint $table) {
            $table->id();
            $table->foreignId('admin_id')->constrained('users')->onDelete('cascade');
            $table->enum('tipe', ['pemasukan', 'pengeluaran']);
            $table->string('keterangan');
            $table->decimal('jumlah', 12, 2);
            $table->timestamp('tanggal')->useCurrent();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_operasional');
    }
};
