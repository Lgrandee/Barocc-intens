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
        Schema::create('planning_ticket', function (Blueprint $table) {
            $table->id();
            $table->enum('catagory', ['meeting', 'installation', 'service']);
            $table->integer('feedback_id')->foreign()->references('id')->on('feedback');
            $table->string('location');
            $table->dateTime('scheduled_time');
            $table->integer('user_id')->foreign()->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('planning_ticket');
    }
};
