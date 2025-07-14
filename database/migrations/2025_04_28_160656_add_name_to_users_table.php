<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    // Sudah dikomentari bagian up-nya
    // public function up(): void
    // {
    //     Schema::table('users', function (Blueprint $table) {
    //         $table->string('name')->after('id');
    //     });
    // }

    public function down(): void
    {
        // Jangan hapus kolom name karena itu penting
        // Schema::table('users', function (Blueprint $table) {
        //     $table->dropColumn('name');
        // });
    }
};
