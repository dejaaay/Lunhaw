<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('sponsorships', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('tree_id')->nullable();
            $table->decimal('amount', 10, 2)->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('tree_id')->references('id')->on('trees')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sponsorships');
    }
};

