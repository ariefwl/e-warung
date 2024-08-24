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
        Schema::table('iklan', function (Blueprint $table) {
            $table->string('kode_kupon')->after('image');
            $table->date('periode_awal')->nullable()->after('kode_kupon');
            $table->date('periode_akhir')->nullable()->after('periode_awal');  
            $table->integer('posisi')->after('status');          
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('iklan', function (Blueprint $table) {
            $table->dropColumn('kode_kupon');
            $table->dropColumn('periode_awal');
            $table->dropColumn('periode_akhir');
            $table->dropColumn('posisi');
        });
    }
};
