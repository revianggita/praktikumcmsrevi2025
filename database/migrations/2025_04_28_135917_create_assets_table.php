<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('category');
            $table->integer('stock');
            $table->string('unit');
            $table->timestamps(); // Untuk kolom created_at dan updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('assets');
    }
};
