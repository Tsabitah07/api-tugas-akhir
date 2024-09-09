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
        Schema::create('mentors', function (Blueprint $table) {
            $table->string('id')->primary();
//            $table->unsignedBigInteger('user_id');
            $table->string('name');
            $table->string('username')->nullable()->unique();
            $table->string('email')->nullable()->unique();
            $table->foreignId('role_id')->default(2);
            $table->foreignId('grade_id');
            $table->string('birth_place');
            $table->string('birth_date');
            $table->integer('age')->nullable();
            $table->string('gender');
            $table->string('experience');
            $table->string('last_education');
            $table->string('last_university')->nullable();
            $table->string('phone_number');
            $table->string('about_me')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('instagram')->nullable();
            $table->string('twitter')->nullable();
            $table->string('facebook')->nullable();
            $table->string('image')->nullable();
            $table->string('password');
            $table->boolean('is_active')->default(true);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mentors');
    }
};
