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
            $table->unsignedBigInteger('user_id')->nullable()->after('id'); // Menambahkan user_id yang nullable
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // Relasi dengan tabel users
        });
    }
    
    public function down()
    {
        Schema::table('boards', function (Blueprint $table) {
            $table->dropForeign(['user_id']); // Menghapus relasi
            $table->dropColumn('user_id'); // Menghapus kolom user_id
        });
    }
    
};
