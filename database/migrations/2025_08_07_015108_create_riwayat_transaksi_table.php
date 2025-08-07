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
        Schema::create('riwayat_transaksi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->enum('tipe', ['setor', 'tarik', 'operasional']);
            $table->enum('kategori', ['pemasukan', 'pengeluaran']);
            $table->decimal('jumlah', 12, 2);
            $table->string('keterangan')->nullable(); // bisa "Setor sampah plastik", "Tarik saldo", dll
            $table->timestamp('tanggal')->useCurrent();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_transaksi');
    }
};
