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
        ];

        foreach ($authors as $a) {
            Author::updateOrCreate(
                ['email' => $a['email']],
                ['name' => $a['name']]
            );
        }

    }
}
