<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // tambahkan
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->string('role')->default('user'); // tambahkan role dengan default 'user'
            $table->timestamps(); // tambahkan created_at & updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
};
