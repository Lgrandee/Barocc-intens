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
        Schema::create('offerte_product', function (Blueprint $table) {
            $table->id();
            $table->integer('offerte_id')->foreign()->references('id')->on('offerte');
            $table->integer('product_id')->foreign()->references('id')->on('product');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offerte_product');
    }
};
