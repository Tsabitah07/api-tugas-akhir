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
        Schema::create('counselings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('grade_id');
            $table->foreignId('student_id');
            $table->dateTime('counseling_date');
            $table->string('time');
            $table->boolean('expired')->default(false);
            $table->string('service');
            $table->string('subject');
            $table->string('place')->nullable();
            $table->foreignId('counseling_status_id')->default(1);
            $table->string('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('counselings');
    }
};
