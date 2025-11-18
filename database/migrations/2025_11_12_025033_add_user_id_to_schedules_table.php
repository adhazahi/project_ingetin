<?php
// database/migrations/xxxx_add_user_id_to_schedules_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('schedules', function (Blueprint $table) {
            // Tambahkan kolom user_id setelah id
            $table->foreignId('user_id')->after('id')->constrained()->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('schedules', function (Blueprint $table) {
            // Hapus foreign key dan kolom saat rollback
            $table->dropConstrainedForeignId('user_id');
        });
    }
};