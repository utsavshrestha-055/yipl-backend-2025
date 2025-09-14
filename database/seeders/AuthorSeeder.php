<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Author;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $authors = [
            ['name' => 'Ram Bahadur', 'email' => 'rambahadur@email.com'],
            ['name' => 'Sushila Karki', 'email' => 'sushilakarki@email.com'],
            ['name' => 'Oli Qaeda', 'email' => 'oliqaeda@email.com'],
            ['name' => 'Santosh Shrestha', 'email' => 'santosh.shrestha@email.com'],
            ['name' => 'Mina Gurung', 'email' => 'mina.gurung@email.com'],
            ['name' => 'Prakash Thapa', 'email' => 'prakash.thapa@email.com'],
            ['name' => 'Anjali Adhikari', 'email' => 'anjali.adhikari@email.com'],
            ['name' => 'Bikash KC', 'email' => 'bikash.kc@email.com'],
            ['name' => 'Sita Magar', 'email' => 'sita.magar@email.com'],
            ['name' => 'Ramesh Bhandari', 'email' => 'ramesh.bhandari@email.com'],
        ];

        foreach ($authors as $a) {
            Author::updateOrCreate(
                ['email' => $a['email']],
                ['name' => $a['name']]
            );
        }

    }
}
