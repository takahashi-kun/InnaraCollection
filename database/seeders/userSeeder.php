<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'Admin Innara',
                'email' => 'user1@gmail.com',
                'no_tlp' => '081234567890',
                'role' => 'admin',
                'password' => '123456789',
            ],
            [
                'name' => 'Customer Innara',
                'email' => 'user@gmail.com',
                'no_tlp' => '089876543210',
                'role' => 'customer',
                'password' => '123456789',
            ],
        ];
        foreach ($data as $item) {
            \App\Models\User::updateOrCreate(
                ['email' => $item['email']],
                [
                    'name' => $item['name'],
                    'no_tlp' => $item['no_tlp'],
                    'role' => $item['role'],
                    'password' => bcrypt($item['password']),
                ]
            );
        }
    }
}
