<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class UpdateTaskStatusEnum extends Migration
{
    public function up()
    {
        DB::statement("ALTER TABLE tasks MODIFY status ENUM('Belum Selesai', 'On Progress', 'Selesai') DEFAULT 'Belum Selesai'");
    }

    public function down()
    {
        DB::statement("ALTER TABLE tasks MODIFY status ENUM('Belum Selesai', 'Selesai') DEFAULT 'Belum Selesai'");
    }
};
