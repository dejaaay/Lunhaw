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
            if (!Schema::hasColumn('trees', 'common_name')) {
                $table->string('common_name', 100)->nullable();
            }
            if (!Schema::hasColumn('trees', 'scientific_name')) {
                $table->string('scientific_name', 150)->nullable();
            }
            if (!Schema::hasColumn('trees', 'description')) {
                $table->text('description')->nullable();
            }
            if (!Schema::hasColumn('trees', 'latitude')) {
                $table->decimal('latitude', 10, 8)->nullable();
            }
            if (!Schema::hasColumn('trees', 'longitude')) {
                $table->decimal('longitude', 11, 8)->nullable();
            }
            if (!Schema::hasColumn('trees', 'planted_at')) {
                $table->dateTime('planted_at')->nullable();
            }
            if (!Schema::hasColumn('trees', 'status')) {
                $table->enum('status', ['planted', 'growing', 'mature'])->default('planted');
            }
            if (!Schema::hasColumn('trees', 'co2_offset')) {
                $table->unsignedInteger('co2_offset')->default(0)->comment('kg CO2');
            }
            if (!Schema::hasColumn('trees', 'current_photo_path')) {
                $table->string('current_photo_path')->nullable();
            }
            if (!Schema::hasColumn('trees', 'notes')) {
                $table->text('notes')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('trees', function (Blueprint $table) {
            $columns = ['common_name', 'scientific_name', 'description', 'latitude', 'longitude', 'planted_at', 'status', 'co2_offset', 'current_photo_path', 'notes'];
            foreach ($columns as $column) {
                if (Schema::hasColumn('trees', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
