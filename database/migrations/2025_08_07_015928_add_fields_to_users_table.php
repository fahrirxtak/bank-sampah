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
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['admin', 'nasabah'])->default('nasabah')->after('password');
            $table->decimal('saldo', 12, 2)->default(0)->after('role');
            $table->enum('status', ['active', 'inactive'])->default('active')->after('saldo');
            $table->text('alamat')->nullable()->after('status');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([ 'role', 'saldo', 'status', 'alamat']);
        });
    }
};
