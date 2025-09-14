<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\Author;
class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ram = Author::where('name', 'Ram Bahadur')->first();
        $karki = Author::where('name', 'Sushila Karki')->first();
        $oli = Author::where('name', 'Oli Qaeda')->first();

        Book::create([
            'title' => 'Rama Bahadur',
            'isbn' => '1234567890',
            'published_year' => 1949,
            'author_id' => $ram->id,
        ]);

        Book::create([
            'title' => 'Nepal Gen-Z',
            'isbn' => '1111111111',
            'published_year' => 1945,
            'author_id' => $ram->id,
        ]);

        Book::create([
            'title' => 'How I became a Prime Minister',
            'isbn' => '9876543211',
            'published_year' => 1997,
            'author_id' => $karki->id,
        ]);

        Book::create([
            'title' => 'Pride and Prejudice',
            'isbn' => '2222222222',
            'published_year' => 1813,
            'author_id' => $oli->id,
        ]);
    }
}
