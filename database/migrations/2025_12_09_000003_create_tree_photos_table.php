<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('tree_photos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('tree_id');
            $table->string('photo_path');
            $table->text('caption')->nullable();
            $table->text('growth_notes')->nullable();
            $table->enum('growth_status', ['planted', 'sprouting', 'growing', 'flowering', 'mature'])->nullable();
            $table->unsignedBigInteger('uploaded_by_user_id')->nullable();
            $table->dateTime('taken_at')->nullable();
            $table->timestamps();

            $table->foreign('tree_id')->references('id')->on('trees')->onDelete('cascade');
            $table->foreign('uploaded_by_user_id')->references('id')->on('users')->onDelete('set null');
            $table->index('tree_id');
            $table->index('taken_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tree_photos');
    }
};
