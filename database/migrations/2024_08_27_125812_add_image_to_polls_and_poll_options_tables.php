<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('polls', function (Blueprint $table) {
            $table->string('image')->nullable()->after('end_date');
        });

        Schema::table('poll_options', function (Blueprint $table) {
            $table->string('image')->nullable()->after('actress_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('polls', function (Blueprint $table) {
            $table->dropColumn('image');
        });

        Schema::table('poll_options', function (Blueprint $table) {
            $table->dropColumn('image');
        });
    }
};
