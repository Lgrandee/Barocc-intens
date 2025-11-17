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
        Schema::create('planning_tickets', function (Blueprint $table) {
            $table->id();
            $table->enum('catagory', ['meeting', 'installation', 'service']);
            $table->foreignId('feedback_id')->constrained('feedbacks');
            $table->string('location');
            $table->dateTime('scheduled_time');
            $table->foreignId('user_id')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('planning_tickets');
    }
};
