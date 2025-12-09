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
        Schema::table('trees', function (Blueprint $table) {
            if (!Schema::hasColumn('trees', 'is_available')) {
                $table->boolean('is_available')->default(true);
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('trees', function (Blueprint $table) {
            if (Schema::hasColumn('trees', 'is_available')) {
                $table->dropColumn('is_available');
            }
        });
    }
};
