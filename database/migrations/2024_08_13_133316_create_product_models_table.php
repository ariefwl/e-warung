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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('id_kategori');
            $table->integer('id_sub_kategori');
            $table->integer('id_sub_sub_kategori');
            $table->integer('id_brand');
            $table->string('nama_product');
            $table->integer('harga');
            $table->string('keterangan');
            $table->string('thumbnail');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
