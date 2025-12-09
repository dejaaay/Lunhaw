<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('trees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->nullable()->comment('NGO/LGU manager');
            $table->string('species', 100);
            $table->string('common_name', 100)->nullable();
            $table->string('scientific_name', 150)->nullable();
            $table->text('description')->nullable();
            $table->string('location', 150)->nullable();
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->dateTime('planted_at')->nullable();
            $table->enum('status', ['planted', 'growing', 'mature'])->default('planted');
            $table->unsignedInteger('co2_offset')->default(0)->comment('kg CO2');
            $table->string('current_photo_path')->nullable();
            $table->text('notes')->nullable();
            $table->boolean('is_available')->default(true);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->index(['status', 'is_available']);
            $table->index(['latitude', 'longitude']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('trees');
    }
};

