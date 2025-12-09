<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Add role field if it doesn't exist
            if (!Schema::hasColumn('users', 'role')) {
                $table->enum('role', ['user', 'admin', 'ngo', 'lgu'])->default('user')->after('password');
            }
            // Add profile photo
            if (!Schema::hasColumn('users', 'profile_photo_path')) {
                $table->string('profile_photo_path')->nullable()->after('role');
            }
            // Add bio
            if (!Schema::hasColumn('users', 'bio')) {
                $table->text('bio')->nullable()->after('profile_photo_path');
            }
            // Add phone
            if (!Schema::hasColumn('users', 'phone')) {
                $table->string('phone')->nullable()->after('bio');
            }
            // Add location/address
            if (!Schema::hasColumn('users', 'address')) {
                $table->text('address')->nullable()->after('phone');
            }
            // Track user status
            if (!Schema::hasColumn('users', 'is_active')) {
                $table->boolean('is_active')->default(true)->after('address');
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $columns = ['role', 'profile_photo_path', 'bio', 'phone', 'address', 'is_active'];
            foreach ($columns as $column) {
                if (Schema::hasColumn('users', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
