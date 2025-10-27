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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('address', 20);
            $table->enum('gender', ["M", "F"]);
            $table->string('education', 20)->nullable();
            $table->string('father_name', 20);
            $table->string('father_occupation', 20);
            $table->string('mother_name', 20);
            $table->string('mother_occupation', 20);
            $table->date('birth_date');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
