<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDemographicFieldsToVotesTable extends Migration
{
    public function up()
    {
        Schema::table('votes', function (Blueprint $table) {
            $table->integer('age')->nullable();
            $table->string('gender')->nullable();
            $table->string('location')->nullable();
        });
    }

    public function down()
    {
        Schema::table('votes', function (Blueprint $table) {
            $table->dropColumn(['age', 'gender', 'location']);
        });
    }
}
