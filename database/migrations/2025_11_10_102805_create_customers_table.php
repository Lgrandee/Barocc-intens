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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name_company');
            $table->string('contact_person');
            $table->string('email')->unique();
            $table->string('phone_number');
            $table->string('bkr_number');
            $table->enum('bkr_status', ['approved', 'denied', 'pending']);
            $table->integer('offerte_id')->foreign()->references('id')->on('offertes');
            $table->integer('factuur_id')->foreign()->references('id')->on('facturen');
            $table->integer('contract_id')->foreign()->references('id')->on('contract');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
