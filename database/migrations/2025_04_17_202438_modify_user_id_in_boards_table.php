<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('boards', function (Blueprint $table) {
            // Jika ingin mengubah kolom user_id menjadi nullable jika belum
            $table->unsignedBigInteger('user_id')->nullable()->change();
        });
    }
    
    public function down()
    {
        Schema::table('boards', function (Blueprint $table) {
            // Kembalikan ke kondisi semula jika diperlukan
            $table->unsignedBigInteger('user_id')->nullable(false)->change();
        });
    }
    
};
