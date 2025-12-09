<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Tree;
use App\Models\Adoption;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create test users
        $user1 = User::create([
            'name' => 'John Adopter',
            'email' => 'john@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        $user2 = User::create([
            'name' => 'Jane Green',
            'email' => 'jane@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        $admin = User::create([
            'name' => 'Admin Manager',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        $ngo = User::create([
            'name' => 'NGO Manager',
            'email' => 'ngo@example.com',
            'password' => Hash::make('password'),
            'role' => 'ngo',
        ]);

        // Create test trees
        $tree1 = Tree::create([
            'user_id' => $ngo->id,
            'species' => 'Mango',
            'common_name' => 'Mango Tree',
            'scientific_name' => 'Mangifera indica',
            'description' => 'A tropical fruit tree known for its delicious mangoes.',
            'location' => 'Quezon City, Metro Manila',
            'latitude' => 14.6349,
            'longitude' => 121.0389,
            'planted_at' => now()->subMonths(6),
            'status' => 'growing',
            'co2_offset' => 25,
            'is_available' => true,
        ]);

        $tree2 = Tree::create([
            'user_id' => $ngo->id,
            'species' => 'Calamansi',
            'common_name' => 'Calamansi Lemon',
            'scientific_name' => 'Citrus microcarpa',
            'description' => 'A small citrus tree commonly used in Filipino cuisine.',
            'location' => 'Marikina, Metro Manila',
            'latitude' => 14.6591,
            'longitude' => 121.5850,
            'planted_at' => now()->subMonths(12),
            'status' => 'mature',
            'co2_offset' => 40,
            'is_available' => true,
        ]);

        $tree3 = Tree::create([
            'user_id' => $ngo->id,
            'species' => 'Narra',
            'common_name' => 'Narra Tree',
            'scientific_name' => 'Pterocarpus indicus',
            'description' => 'The national tree of the Philippines, valued for its wood.',
            'location' => 'Rizal Province',
            'latitude' => 14.5821,
            'longitude' => 121.2927,
            'planted_at' => now()->subMonths(3),
            'status' => 'planted',
            'co2_offset' => 15,
            'is_available' => true,
        ]);

        // Create adoption
        Adoption::create([
            'user_id' => $user1->id,
            'tree_id' => $tree1->id,
            'status' => 'active',
            'adopted_at' => now()->subMonths(2),
        ]);

        $tree1->update(['is_available' => false]);

        // User::factory(10)->create();
    }
}

