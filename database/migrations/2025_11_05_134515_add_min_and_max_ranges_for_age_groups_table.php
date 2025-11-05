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
        Schema::table('age_groups', function (Blueprint $table) {
            $table->date("min_birthdate")->default("2002-01-01");
            $table->date("max_birthdate")->default("2005-01-01");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('age_groups', function (Blueprint $table) {
            $table->dropColumn("min_birthdate");
            $table->dropColumn("max_birthdate");
        });
    }
};
