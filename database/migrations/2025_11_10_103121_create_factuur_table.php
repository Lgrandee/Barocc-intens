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
        Schema::create('facturen', function (Blueprint $table) {
            $table->id();
            $table->foreignId('name_company_id')->constrained('customers')->onDelete('cascade');
            $table->date('invoice_date');
            $table->date('due_date');
            $table->string('reference', 100)->nullable(); // Contract/Offerte referentie
            $table->enum('payment_method', ['bank_transfer', 'ideal', 'creditcard', 'cash'])->default('bank_transfer');
            $table->text('description')->nullable(); // Factuur omschrijving
            $table->text('notes')->nullable(); // Interne notities
            $table->enum('status', ['concept', 'verzonden', 'betaald', 'verlopen']);
            $table->timestamp('sent_at')->nullable(); // Wanneer verstuurd
            $table->timestamp('paid_at')->nullable(); // Wanneer betaald
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facturen');
    }
};
