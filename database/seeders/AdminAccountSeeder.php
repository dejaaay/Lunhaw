<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminAccountSeeder extends Seeder
{
    public function run()
    {
        User::updateOrCreate([
            'email' => 'admin@lunhaw.local',
        ], [
            'name' => 'Admin User',
            'password' => Hash::make('admin1234'),
            'role' => 'admin',
            'phone' => null,
            'address' => null,
        ]);
    }
}
