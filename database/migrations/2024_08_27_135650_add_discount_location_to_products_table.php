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
        Schema::table('products', function (Blueprint $table) {
            $table->integer('diskon')->after('harga');
            $table->string('lokasi_toko')->after('keterangan');
            $table->integer('type_product')->after('lokasi_toko');
            $table->integer('stock')->after('lokasi_toko');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('diskon');
            $table->dropColumn('lokasi_toko');
            $table->dropColumn('type_product');
            $table->dropColumn('stock');
        });
    }
};
