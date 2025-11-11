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
            $table->foreignId('name_company_id')->constrained('customers');
            $table->foreignId('product_id')->constrained('products');
            $table->date('invoice_date');
            $table->date('due_date');
            $table->enum('status', ['paid', 'unpaid', 'overdue']);
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
