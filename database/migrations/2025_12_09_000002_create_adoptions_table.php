<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('adoptions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('tree_id');
            $table->enum('status', ['active', 'inactive', 'transferred'])->default('active');
            $table->dateTime('adopted_at')->nullable();
            $table->dateTime('transferred_at')->nullable();
            $table->unsignedBigInteger('transferred_to_user_id')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('tree_id')->references('id')->on('trees')->onDelete('cascade');
            $table->foreign('transferred_to_user_id')->references('id')->on('users')->onDelete('set null');
            $table->unique(['user_id', 'tree_id']);
            $table->index(['status', 'user_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('adoptions');
    }
};
