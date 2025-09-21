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
        // Add a visits counter to manuals table
        Schema::table('manuals', function (Blueprint $table) {
            $table->unsignedBigInteger('visits')->default(0)->after('downloadedServer');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Remove the visits counter
        Schema::table('manuals', function (Blueprint $table) {
            $table->dropColumn('visits');
        });
    }
};
