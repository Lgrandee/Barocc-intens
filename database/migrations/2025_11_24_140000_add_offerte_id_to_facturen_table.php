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
        Schema::table('facturen', function (Blueprint $table) {
            $table->foreignId('offerte_id')->nullable()->after('name_company_id')->constrained('offertes')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('facturen', function (Blueprint $table) {
            $table->dropForeign(['offerte_id']);
            $table->dropColumn('offerte_id');
        });
    }
};
