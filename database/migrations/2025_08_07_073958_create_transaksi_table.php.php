<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id();

            // Relasi user & admin
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('admin_id')->nullable()->constrained('users')->onDelete('set null');

            // Jenis transaksi: setor sampah, setor tunai, tarik tunai
            $table->enum('jenis_transaksi', ['setor_sampah', 'setor_tunai', 'tarik_tunai']);

            // Data sampah (jika jenis setor_sampah)
            $table->foreignId('sampah_id')->nullable()->constrained('sampah')->onDelete('set null');
            $table->decimal('berat', 8, 2)->nullable()->comment('Berat sampah dalam kilogram');
            $table->decimal('harga_per_kg', 12, 2)->nullable()->comment('Harga per kg sampah');
            $table->decimal('total_harga', 12, 2)->nullable()->comment('Total (berat x harga_per_kg)');

            // Data uang (setor/tarik tunai)
            $table->decimal('jumlah_uang', 12, 2)->nullable()->comment('Jumlah uang untuk setor/tarik');

            // Status transaksi
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->enum('metode_penarikan', ['tunai', 'transfer'])->nullable();

            // Catatan dan alasan tolak
            $table->text('catatan')->nullable();
            $table->text('alasan_tolak')->nullable();

            $table->timestamps();

            // Indexing untuk efisiensi query
            $table->index(['user_id', 'created_at'], 'idx_user_created');
            $table->index(['jenis_transaksi', 'status'], 'idx_jenis_status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
