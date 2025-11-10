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
        Schema::create('offerte', function (Blueprint $table) {
            $table->id();
            $table->integer('name_company_id')->foreign()->references('name_company')->on('customer');
            $table->integer('product_id')->foreign()->references('id')->on('product');
            $table->enum('status', ['accepted', 'rejected', 'pending']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offerte');
    }
};
