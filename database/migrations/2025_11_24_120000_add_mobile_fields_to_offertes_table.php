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
        Schema::table('offertes', function (Blueprint $table) {
            $table->date('valid_until')->nullable()->after('status');
            $table->integer('delivery_time_weeks')->nullable()->after('valid_until');
            $table->integer('payment_terms_days')->nullable()->after('delivery_time_weeks');
            $table->text('custom_terms')->nullable()->after('payment_terms_days');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('offertes', function (Blueprint $table) {
            $table->dropColumn(['valid_until', 'delivery_time_weeks', 'payment_terms_days', 'custom_terms']);
        });
    }
};
