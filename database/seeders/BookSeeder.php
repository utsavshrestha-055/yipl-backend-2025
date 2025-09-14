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
        $map = [
            ['title' => 'Rama Bahadur', 'isbn' => '1234567890', 'published_year' => 1949, 'author_email' => 'rambahadur@email.com'],
            ['title' => 'How I became a Prime Minister', 'isbn' => '1111111111', 'published_year' => 1945, 'author_email' => 'sushilakarki@email.com'],
            ['title' => "Oli Qaeda", 'isbn' => '9876543211', 'published_year' => 1997, 'author_email' => 'oliqaeda@email.com'],
            ['title' => 'Gen-Z', 'isbn' => '2222222222', 'published_year' => 1813, 'author_email' => 'oliqaeda@email.com'],
        ];

        foreach ($map as $m) {
            $author = Author::where('email', $m['author_email'])->first();
            if (!$author) continue;

            Book::updateOrCreate(
                ['isbn' => $m['isbn']],
                [
                    'title' => $m['title'],
                    'published_year' => $m['published_year'],
                    'author_id' => $author->id,
                ]
            );
        }
    }
}
