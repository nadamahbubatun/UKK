<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nama task
            $table->foreignId('list_id')->constrained('lists')->onDelete('cascade'); // Hubungan dengan list
            $table->enum('status', ['Selesai', 'Belum Selesai'])->default('Belum Selesai');
            $table->enum('priority', ['Rendah', 'Sedang', 'Tinggi']);  
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tasks');
    }
};
 