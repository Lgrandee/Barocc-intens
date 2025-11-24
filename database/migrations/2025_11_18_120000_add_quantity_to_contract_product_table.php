<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('contract_product', function (Blueprint $table) {
            $table->unsignedInteger('quantity')->default(1)->after('product_id');
            $table->dropUnique(['contract_id', 'product_id']); // allow multiple of same product
        });
    }

    public function down(): void
    {
        Schema::table('contract_product', function (Blueprint $table) {
            $table->dropColumn('quantity');
            $table->unique(['contract_id', 'product_id']);
        });
    }
};
