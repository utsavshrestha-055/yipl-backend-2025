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
        Author::create(['name' => 'Ram Bahadur', 'email' => 'rambahadur@email.com']);
        Author::create(['name' => 'Sushila Karki', 'email' => 'sushilakarki@email.com']);
        Author::create(['name' => 'Oli Qaeda', 'email' => 'oliqaeda@email.com']);
    }
}
