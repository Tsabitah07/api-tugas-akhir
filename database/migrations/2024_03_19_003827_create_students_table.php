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
            $table->string('nis');
            $table->string('email')->nullable();
            $table->string('username')->nullable()->unique();
            $table->string('name');
            $table->foreignId('role_id')->default(3);
            $table->foreignId('grade_id');
            $table->string('phone_number')->nullable();
            $table->string('birth_place')->nullable();
            $table->string('birth_date');
            $table->string('year_of_entry')->nullable();
            $table->string('password');
            $table->string('image')->nullable();
            $table->rememberToken();
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
