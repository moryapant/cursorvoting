<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActressesTable extends Migration
{
    public function up()
    {
        Schema::create('actresses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('points')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('actresses');
    }
}
