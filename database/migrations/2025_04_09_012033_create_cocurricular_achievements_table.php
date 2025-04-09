<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('cocurricular_achievements', function (Blueprint $table) {
            $table->id();
            $table->string('event_title');
            $table->string('category'); // Robotics, Sports, Debate, etc.
            $table->string('placement_type'); // Gold, Silver, Bronze, Scholarship
            $table->integer('student_count');
            $table->date('event_date');
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cocurricular_achievements');
    }
};