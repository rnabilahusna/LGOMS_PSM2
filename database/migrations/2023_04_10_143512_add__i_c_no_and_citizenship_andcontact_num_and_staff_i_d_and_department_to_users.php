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
        Schema::table('users', function (Blueprint $table) {
            $table->string('ICNo');
            $table->string('citizenship');
            $table->string('contactNum');
            $table->string('staffID');
            $table->string('department');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('ICNo');
            $table->dropColumn('citizenship');
            $table->dropColumn('contactNum');
            $table->dropColumn('staffID');
            $table->dropColumn('department');
        });
    }
};
