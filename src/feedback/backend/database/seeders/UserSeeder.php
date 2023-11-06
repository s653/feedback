<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'admin',
                'email' => 'admin@feedback.com',
                'password' => bcrypt('11223344'),
                'role' => 1,
                'photo' => 'https://randomuser.me/api/portraits/men/' . rand(1, 50) . '.jpg',
            ],
            [
                'name' => 'Waheed Ahmad',
                'email' => 'waheedsaeed053@gmail.com',
                'password' => bcrypt('11223344'),
                'role' => 2,
                'photo' => 'https://randomuser.me/api/portraits/men/' . rand(1, 50) . '.jpg',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Test User',
                'email' => 'user@feedback.com',
                'password' => bcrypt('11223344'),
                'role' => 2,
                'photo' => 'https://randomuser.me/api/portraits/men/' . rand(1, 50) . '.jpg',
                'email_verified_at' => now(),
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
