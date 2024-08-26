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
        Schema::create('official_store', function (Blueprint $table) {
            $table->id();
            $table->string('nama_store');
            $table->string('keterangan');
            $table->string('image');
            $table->string('link_facebook');
            $table->string('link_x');
            $table->integer('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('official_store_models');
    }
};
