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
        // Add a default admin account
        $admin = User::firstOrCreate(
            [ 'email' => 'admin@lunhaw.local' ],
            [
                'name' => 'Lunhaw Admin',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ]
        );
        // Add Quezon City as a partner/NGO
        $quezonCity = User::firstOrCreate(
            [ 'email' => 'info@quezoncity.gov.ph' ],
            [
                'name' => 'Quezon City',
                'password' => Hash::make('password'),
                'role' => 'ngo',
                'bio' => 'Lungsod Quezon, Pilipinas',
                'profile_photo_path' => 'quezoncity-logo.png', // Place logo in public/images
            ]
        );
        // Create test users
    $user1 = User::firstOrCreate([
            'name' => 'John Adopter',
            'email' => 'john@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

    $user2 = User::firstOrCreate([
            'name' => 'Jane Green',
            'email' => 'jane@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

    $admin = User::firstOrCreate([
            'name' => 'Admin Manager',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);



        // Add UNESCO as a partner/NGO
        $unesco = User::firstOrCreate(
            [ 'email' => 'contact@unesco.org' ],
            [
                'name' => 'UNESCO',
                'password' => Hash::make('password'),
                'role' => 'ngo',
                'bio' => 'United Nations Educational, Scientific, Cultural Organization',
                'profile_photo_path' => 'unesco-logo.jpg', // Place logo in public/images
            ]
        );


        // Create test trees

        $treeData = [
            [
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
            ],
            [
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
            ],
            [
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
            ],
            [ 'species' => 'Acacia', 'common_name' => 'Acacia', 'scientific_name' => 'Acacia auriculiformis', 'description' => 'A fast-growing tree used for shade and timber.', 'location' => 'Laguna', 'latitude' => 14.1700, 'longitude' => 121.2500, 'planted_at' => now()->subMonths(8), 'status' => 'growing', 'co2_offset' => 20 ],
            [ 'species' => 'Mahogany', 'common_name' => 'Mahogany', 'scientific_name' => 'Swietenia macrophylla', 'description' => 'A valuable hardwood tree.', 'location' => 'Batangas', 'latitude' => 13.7565, 'longitude' => 121.0583, 'planted_at' => now()->subMonths(10), 'status' => 'mature', 'co2_offset' => 35 ],
            [ 'species' => 'Bamboo', 'common_name' => 'Bamboo', 'scientific_name' => 'Bambusoideae', 'description' => 'A fast-growing grass used for construction.', 'location' => 'Bulacan', 'latitude' => 14.7928, 'longitude' => 120.8786, 'planted_at' => now()->subMonths(5), 'status' => 'growing', 'co2_offset' => 10 ],
            [ 'species' => 'Ipil-ipil', 'common_name' => 'Ipil-ipil', 'scientific_name' => 'Leucaena leucocephala', 'description' => 'A nitrogen-fixing tree.', 'location' => 'Pampanga', 'latitude' => 15.0794, 'longitude' => 120.6194, 'planted_at' => now()->subMonths(7), 'status' => 'growing', 'co2_offset' => 12 ],
            [ 'species' => 'Molave', 'common_name' => 'Molave', 'scientific_name' => 'Vitex parviflora', 'description' => 'A strong and durable wood.', 'location' => 'Cavite', 'latitude' => 14.4791, 'longitude' => 120.8969, 'planted_at' => now()->subMonths(9), 'status' => 'mature', 'co2_offset' => 30 ],
            [ 'species' => 'Balete', 'common_name' => 'Balete', 'scientific_name' => 'Ficus balete', 'description' => 'A fig tree with aerial roots.', 'location' => 'Quezon', 'latitude' => 13.9644, 'longitude' => 122.1561, 'planted_at' => now()->subMonths(4), 'status' => 'growing', 'co2_offset' => 18 ],
            [ 'species' => 'Bitaog', 'common_name' => 'Bitaog', 'scientific_name' => 'Calophyllum inophyllum', 'description' => 'A coastal tree with fragrant flowers.', 'location' => 'Palawan', 'latitude' => 9.8349, 'longitude' => 118.7384, 'planted_at' => now()->subMonths(11), 'status' => 'mature', 'co2_offset' => 22 ],
            [ 'species' => 'Agoho', 'common_name' => 'Agoho', 'scientific_name' => 'Casuarina equisetifolia', 'description' => 'A pine-like tree found near coasts.', 'location' => 'Ilocos Norte', 'latitude' => 18.1647, 'longitude' => 120.7478, 'planted_at' => now()->subMonths(6), 'status' => 'growing', 'co2_offset' => 16 ],
            [ 'species' => 'Yakal', 'common_name' => 'Yakal', 'scientific_name' => 'Shorea astylosa', 'description' => 'A hardwood tree endemic to the Philippines.', 'location' => 'Zambales', 'latitude' => 15.3333, 'longitude' => 120.1667, 'planted_at' => now()->subMonths(13), 'status' => 'mature', 'co2_offset' => 38 ],
            [ 'species' => 'Tanguile', 'common_name' => 'Tanguile', 'scientific_name' => 'Shorea polysperma', 'description' => 'A red lauan species.', 'location' => 'Nueva Ecija', 'latitude' => 15.7151, 'longitude' => 121.1251, 'planted_at' => now()->subMonths(8), 'status' => 'growing', 'co2_offset' => 21 ],
            [ 'species' => 'Almaciga', 'common_name' => 'Almaciga', 'scientific_name' => 'Agathis philippinensis', 'description' => 'A resin-producing tree.', 'location' => 'Davao', 'latitude' => 7.1907, 'longitude' => 125.4553, 'planted_at' => now()->subMonths(14), 'status' => 'mature', 'co2_offset' => 42 ],
            [ 'species' => 'Bitaog', 'common_name' => 'Bitaog', 'scientific_name' => 'Calophyllum inophyllum', 'description' => 'A coastal tree with fragrant flowers.', 'location' => 'Palawan', 'latitude' => 9.8349, 'longitude' => 118.7384, 'planted_at' => now()->subMonths(11), 'status' => 'mature', 'co2_offset' => 22 ],
            [ 'species' => 'Dao', 'common_name' => 'Dao', 'scientific_name' => 'Dracontomelon dao', 'description' => 'A large tree with edible fruit.', 'location' => 'Leyte', 'latitude' => 10.9757, 'longitude' => 124.4822, 'planted_at' => now()->subMonths(7), 'status' => 'growing', 'co2_offset' => 19 ],
            [ 'species' => 'Dita', 'common_name' => 'Dita', 'scientific_name' => 'Alstonia scholaris', 'description' => 'A medicinal tree.', 'location' => 'Bohol', 'latitude' => 9.8499, 'longitude' => 124.1435, 'planted_at' => now()->subMonths(5), 'status' => 'growing', 'co2_offset' => 13 ],
            [ 'species' => 'Gmelina', 'common_name' => 'Gmelina', 'scientific_name' => 'Gmelina arborea', 'description' => 'A fast-growing timber tree.', 'location' => 'Cebu', 'latitude' => 10.3157, 'longitude' => 123.8854, 'planted_at' => now()->subMonths(6), 'status' => 'growing', 'co2_offset' => 17 ],
            [ 'species' => 'Kamagong', 'common_name' => 'Kamagong', 'scientific_name' => 'Diospyros blancoi', 'description' => 'A tree known for its hard, dark wood.', 'location' => 'Quezon Province', 'latitude' => 13.9644, 'longitude' => 122.1561, 'planted_at' => now()->subMonths(12), 'status' => 'mature', 'co2_offset' => 36 ],
            [ 'species' => 'Lauan', 'common_name' => 'Lauan', 'scientific_name' => 'Shorea negrosensis', 'description' => 'A red lauan species.', 'location' => 'Negros', 'latitude' => 9.9827, 'longitude' => 122.8043, 'planted_at' => now()->subMonths(8), 'status' => 'growing', 'co2_offset' => 23 ],
            [ 'species' => 'Molave', 'common_name' => 'Molave', 'scientific_name' => 'Vitex parviflora', 'description' => 'A strong and durable wood.', 'location' => 'Cavite', 'latitude' => 14.4791, 'longitude' => 120.8969, 'planted_at' => now()->subMonths(9), 'status' => 'mature', 'co2_offset' => 30 ],
            [ 'species' => 'Talisay', 'common_name' => 'Talisay', 'scientific_name' => 'Terminalia catappa', 'description' => 'A coastal tree with large leaves.', 'location' => 'Zamboanga', 'latitude' => 6.9214, 'longitude' => 122.0790, 'planted_at' => now()->subMonths(10), 'status' => 'growing', 'co2_offset' => 20 ],
            [ 'species' => 'Santol', 'common_name' => 'Santol', 'scientific_name' => 'Sandoricum koetjape', 'description' => 'A tropical fruit tree.', 'location' => 'Pangasinan', 'latitude' => 15.9804, 'longitude' => 120.5606, 'planted_at' => now()->subMonths(7), 'status' => 'growing', 'co2_offset' => 14 ],
            [ 'species' => 'Sampaloc', 'common_name' => 'Tamarind', 'scientific_name' => 'Tamarindus indica', 'description' => 'A tree producing sour fruit.', 'location' => 'Nueva Vizcaya', 'latitude' => 16.3292, 'longitude' => 121.1031, 'planted_at' => now()->subMonths(8), 'status' => 'growing', 'co2_offset' => 15 ],
            [ 'species' => 'Bignay', 'common_name' => 'Bignay', 'scientific_name' => 'Antidesma bunius', 'description' => 'A fruit-bearing tree.', 'location' => 'Isabela', 'latitude' => 17.2235, 'longitude' => 121.7468, 'planted_at' => now()->subMonths(6), 'status' => 'growing', 'co2_offset' => 12 ],
            [ 'species' => 'Guava', 'common_name' => 'Guava', 'scientific_name' => 'Psidium guajava', 'description' => 'A tropical fruit tree.', 'location' => 'Cagayan', 'latitude' => 18.1960, 'longitude' => 121.7269, 'planted_at' => now()->subMonths(5), 'status' => 'growing', 'co2_offset' => 11 ],
            [ 'species' => 'Jackfruit', 'common_name' => 'Jackfruit', 'scientific_name' => 'Artocarpus heterophyllus', 'description' => 'A tree with large edible fruit.', 'location' => 'Samar', 'latitude' => 12.0000, 'longitude' => 124.7500, 'planted_at' => now()->subMonths(7), 'status' => 'growing', 'co2_offset' => 16 ],
            [ 'species' => 'Avocado', 'common_name' => 'Avocado', 'scientific_name' => 'Persea americana', 'description' => 'A tree with creamy fruit.', 'location' => 'Bukidnon', 'latitude' => 8.1572, 'longitude' => 125.1277, 'planted_at' => now()->subMonths(8), 'status' => 'growing', 'co2_offset' => 18 ],
            [ 'species' => 'Papaya', 'common_name' => 'Papaya', 'scientific_name' => 'Carica papaya', 'description' => 'A tropical fruit tree.', 'location' => 'Davao del Sur', 'latitude' => 6.7516, 'longitude' => 125.3572, 'planted_at' => now()->subMonths(6), 'status' => 'growing', 'co2_offset' => 13 ],
            [ 'species' => 'Rambutan', 'common_name' => 'Rambutan', 'scientific_name' => 'Nephelium lappaceum', 'description' => 'A tropical fruit tree.', 'location' => 'Agusan del Norte', 'latitude' => 9.0132, 'longitude' => 125.6131, 'planted_at' => now()->subMonths(7), 'status' => 'growing', 'co2_offset' => 14 ],
            [ 'species' => 'Lanzones', 'common_name' => 'Lanzones', 'scientific_name' => 'Lansium domesticum', 'description' => 'A tropical fruit tree.', 'location' => 'Camiguin', 'latitude' => 9.1735, 'longitude' => 124.7297, 'planted_at' => now()->subMonths(8), 'status' => 'growing', 'co2_offset' => 15 ],
            [ 'species' => 'Durian', 'common_name' => 'Durian', 'scientific_name' => 'Durio zibethinus', 'description' => 'A tree with large, spiky fruit.', 'location' => 'Davao City', 'latitude' => 7.1907, 'longitude' => 125.4553, 'planted_at' => now()->subMonths(9), 'status' => 'growing', 'co2_offset' => 17 ],
            [ 'species' => 'Macopa', 'common_name' => 'Macopa', 'scientific_name' => 'Syzygium samarangense', 'description' => 'A tree with bell-shaped fruit.', 'location' => 'Misamis Oriental', 'latitude' => 8.5122, 'longitude' => 124.6319, 'planted_at' => now()->subMonths(10), 'status' => 'growing', 'co2_offset' => 12 ],
            [ 'species' => 'Star Apple', 'common_name' => 'Star Apple', 'scientific_name' => 'Chrysophyllum cainito', 'description' => 'A tree with sweet, star-shaped fruit.', 'location' => 'Sorsogon', 'latitude' => 12.9746, 'longitude' => 124.0145, 'planted_at' => now()->subMonths(11), 'status' => 'growing', 'co2_offset' => 13 ],
            [ 'species' => 'Atis', 'common_name' => 'Sugar Apple', 'scientific_name' => 'Annona squamosa', 'description' => 'A tree with sweet, segmented fruit.', 'location' => 'Tarlac', 'latitude' => 15.4802, 'longitude' => 120.5976, 'planted_at' => now()->subMonths(12), 'status' => 'growing', 'co2_offset' => 14 ],
            [ 'species' => 'Sineguelas', 'common_name' => 'Spanish Plum', 'scientific_name' => 'Spondias purpurea', 'description' => 'A tree with small, tart fruit.', 'location' => 'Zambales', 'latitude' => 15.3333, 'longitude' => 120.1667, 'planted_at' => now()->subMonths(13), 'status' => 'growing', 'co2_offset' => 12 ],
            [ 'species' => 'Cacao', 'common_name' => 'Cacao', 'scientific_name' => 'Theobroma cacao', 'description' => 'A tree used for chocolate production.', 'location' => 'Davao Oriental', 'latitude' => 7.0982, 'longitude' => 126.5374, 'planted_at' => now()->subMonths(14), 'status' => 'growing', 'co2_offset' => 15 ],
            [ 'species' => 'Coffee', 'common_name' => 'Coffee', 'scientific_name' => 'Coffea liberica', 'description' => 'A tree used for coffee beans.', 'location' => 'Batangas', 'latitude' => 13.7565, 'longitude' => 121.0583, 'planted_at' => now()->subMonths(15), 'status' => 'growing', 'co2_offset' => 13 ],
            [ 'species' => 'Pili', 'common_name' => 'Pili Nut', 'scientific_name' => 'Canarium ovatum', 'description' => 'A tree producing edible nuts.', 'location' => 'Albay', 'latitude' => 13.1391, 'longitude' => 123.7438, 'planted_at' => now()->subMonths(16), 'status' => 'growing', 'co2_offset' => 14 ],
            [ 'species' => 'Mangosteen', 'common_name' => 'Mangosteen', 'scientific_name' => 'Garcinia mangostana', 'description' => 'A tree with sweet, tangy fruit.', 'location' => 'Sultan Kudarat', 'latitude' => 6.5061, 'longitude' => 124.4198, 'planted_at' => now()->subMonths(17), 'status' => 'growing', 'co2_offset' => 15 ],
            [ 'species' => 'Guyabano', 'common_name' => 'Soursop', 'scientific_name' => 'Annona muricata', 'description' => 'A tree with large, spiky fruit.', 'location' => 'Surigao del Sur', 'latitude' => 8.5294, 'longitude' => 126.1109, 'planted_at' => now()->subMonths(18), 'status' => 'growing', 'co2_offset' => 16 ],
            [ 'species' => 'Duhat', 'common_name' => 'Java Plum', 'scientific_name' => 'Syzygium cumini', 'description' => 'A tree with small, dark fruit.', 'location' => 'Camarines Sur', 'latitude' => 13.3690, 'longitude' => 123.4456, 'planted_at' => now()->subMonths(19), 'status' => 'growing', 'co2_offset' => 12 ],
            [ 'species' => 'Aratiles', 'common_name' => 'Jamaican Cherry', 'scientific_name' => 'Muntingia calabura', 'description' => 'A tree with small, sweet fruit.', 'location' => 'Aklan', 'latitude' => 11.6079, 'longitude' => 122.2465, 'planted_at' => now()->subMonths(20), 'status' => 'growing', 'co2_offset' => 11 ],
            [ 'species' => 'Balimbing', 'common_name' => 'Starfruit', 'scientific_name' => 'Averrhoa carambola', 'description' => 'A tree with star-shaped fruit.', 'location' => 'Antique', 'latitude' => 10.7376, 'longitude' => 121.9507, 'planted_at' => now()->subMonths(21), 'status' => 'growing', 'co2_offset' => 13 ],
            [ 'species' => 'Bayabas', 'common_name' => 'Guava', 'scientific_name' => 'Psidium guajava', 'description' => 'A tropical fruit tree.', 'location' => 'Bataan', 'latitude' => 14.6780, 'longitude' => 120.5363, 'planted_at' => now()->subMonths(22), 'status' => 'growing', 'co2_offset' => 12 ],
            [ 'species' => 'Camachile', 'common_name' => 'Manila Tamarind', 'scientific_name' => 'Pithecellobium dulce', 'description' => 'A tree with sweet, pink fruit.', 'location' => 'Basilan', 'latitude' => 6.5616, 'longitude' => 122.0771, 'planted_at' => now()->subMonths(23), 'status' => 'growing', 'co2_offset' => 11 ],
            [ 'species' => 'Tambis', 'common_name' => 'Water Apple', 'scientific_name' => 'Syzygium aqueum', 'description' => 'A tree with bell-shaped fruit.', 'location' => 'Biliran', 'latitude' => 11.5833, 'longitude' => 124.4667, 'planted_at' => now()->subMonths(24), 'status' => 'growing', 'co2_offset' => 10 ],
            [ 'species' => 'Tisa', 'common_name' => 'Tisa', 'scientific_name' => 'Manilkara zapota', 'description' => 'A tree with sweet, brown fruit.', 'location' => 'Benguet', 'latitude' => 16.6156, 'longitude' => 120.3198, 'planted_at' => now()->subMonths(25), 'status' => 'growing', 'co2_offset' => 13 ],
            [ 'species' => 'Kalumpit', 'common_name' => 'Kalumpit', 'scientific_name' => 'Terminalia microcarpa', 'description' => 'A tree with edible fruit.', 'location' => 'Bohol', 'latitude' => 9.8499, 'longitude' => 124.1435, 'planted_at' => now()->subMonths(26), 'status' => 'growing', 'co2_offset' => 12 ],
            [ 'species' => 'Mabolo', 'common_name' => 'Velvet Apple', 'scientific_name' => 'Diospyros blancoi', 'description' => 'A tree with velvety fruit.', 'location' => 'Camarines Norte', 'latitude' => 14.1225, 'longitude' => 122.9026, 'planted_at' => now()->subMonths(27), 'status' => 'growing', 'co2_offset' => 13 ],
            [ 'species' => 'Santan', 'common_name' => 'Ixora', 'scientific_name' => 'Ixora coccinea', 'description' => 'A flowering shrub.', 'location' => 'Catanduanes', 'latitude' => 13.7089, 'longitude' => 124.2372, 'planted_at' => now()->subMonths(28), 'status' => 'growing', 'co2_offset' => 10 ],
            [ 'species' => 'Rosal', 'common_name' => 'Gardenia', 'scientific_name' => 'Gardenia jasminoides', 'description' => 'A fragrant flowering shrub.', 'location' => 'Cavite', 'latitude' => 14.4791, 'longitude' => 120.8969, 'planted_at' => now()->subMonths(29), 'status' => 'growing', 'co2_offset' => 10 ],
            [ 'species' => 'Ilang-ilang', 'common_name' => 'Ylang-ylang', 'scientific_name' => 'Cananga odorata', 'description' => 'A tree with fragrant flowers.', 'location' => 'Laguna', 'latitude' => 14.1700, 'longitude' => 121.2500, 'planted_at' => now()->subMonths(30), 'status' => 'growing', 'co2_offset' => 11 ],
        ];

        $treeIds = [];
        $owners = [$unesco, $quezonCity];
        $ownerCount = count($owners);
        foreach ($treeData as $i => $tree) {
            $owner = $owners[$i % $ownerCount];
            $treeModel = Tree::create([
                'user_id' => $owner->id,
                'species' => $tree['species'],
                'common_name' => $tree['common_name'],
                'scientific_name' => $tree['scientific_name'],
                'description' => $tree['description'],
                'location' => $tree['location'],
                'latitude' => $tree['latitude'],
                'longitude' => $tree['longitude'],
                'planted_at' => $tree['planted_at'],
                'status' => $tree['status'],
                'co2_offset' => $tree['co2_offset'],
                'is_available' => true,
            ]);
            $treeIds[] = $treeModel->id;

            // Create a completed sponsorship for each tree by the owner
            \App\Models\Sponsorship::create([
                'user_id' => $owner->id,
                'tree_id' => $treeModel->id,
                'amount' => 1000.00,
                'status' => 'completed',
                'payment_method' => 'bank_transfer',
                'transaction_reference' => 'SPONSOR-' . $treeModel->id,
                'paid_at' => now()->subDays(rand(1, 365)),
                'notes' => 'Seeded sponsorship',
            ]);
        }

        // Create adoption
        // Adopt the first tree for user1
        if (count($treeIds) > 0) {
            Adoption::create([
                'user_id' => $user1->id,
                'tree_id' => $treeIds[0],
                'status' => 'active',
                'adopted_at' => now()->subMonths(2),
            ]);
            \App\Models\Tree::find($treeIds[0])->update(['is_available' => false]);
        }

        // User::factory(10)->create();
    }
}
