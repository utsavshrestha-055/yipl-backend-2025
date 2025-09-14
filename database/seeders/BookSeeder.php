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
      $books = [
            ['title' => 'Rama Bahadur', 'isbn' => '1234567890', 'published_year' => 1949, 'author_email' => 'rambahadur@email.com'],
            ['title' => 'How I Became a Prime Minister', 'isbn' => '1111111111', 'published_year' => 1945, 'author_email' => 'sushilakarki@email.com'],
            ['title' => 'Oli Qaeda', 'isbn' => '9876543211', 'published_year' => 1997, 'author_email' => 'oliqaeda@email.com'],
            ['title' => 'Gen-Z Chronicles', 'isbn' => '2222222222', 'published_year' => 1813, 'author_email' => 'oliqaeda@email.com'],
            ['title' => 'Kathmandu Diaries', 'isbn' => '3333333333', 'published_year' => 2005, 'author_email' => 'santosh.shrestha@email.com'],
            ['title' => 'Himalayan Adventure', 'isbn' => '4444444444', 'published_year' => 2010, 'author_email' => 'mina.gurung@email.com'],
            ['title' => 'Nepalese History', 'isbn' => '5555555555', 'published_year' => 1995, 'author_email' => 'prakash.thapa@email.com'],
            ['title' => 'Mountains and Rivers', 'isbn' => '6666666666', 'published_year' => 2000, 'author_email' => 'anjali.adhikari@email.com'],
            ['title' => 'The Gurung Tales', 'isbn' => '7777777777', 'published_year' => 2015, 'author_email' => 'mina.gurung@email.com'],
            ['title' => 'Shrestha Legacy', 'isbn' => '8888888888', 'published_year' => 2018, 'author_email' => 'santosh.shrestha@email.com'],
            ['title' => 'Bikash\'s Notebook', 'isbn' => '9999999990', 'published_year' => 2020, 'author_email' => 'bikash.kc@email.com'],
            ['title' => 'Magar Folk Stories', 'isbn' => '1010101010', 'published_year' => 2022, 'author_email' => 'sita.magar@email.com'],
            ['title' => 'Bhandari Memoirs', 'isbn' => '1212121212', 'published_year' => 2008, 'author_email' => 'ramesh.bhandari@email.com'],
            ['title' => 'Nepali Poetry', 'isbn' => '1313131313', 'published_year' => 2011, 'author_email' => 'anjali.adhikari@email.com'],
            ['title' => 'Thapa Chronicles', 'isbn' => '1414141414', 'published_year' => 1999, 'author_email' => 'prakash.thapa@email.com'],
        ];

        foreach ($books as $b) {
            $author = Author::where('email', $b['author_email'])->first();
            if (!$author) continue;

            Book::updateOrCreate(
                ['isbn' => $b['isbn']],
                [
                    'title' => $b['title'],
                    'published_year' => $b['published_year'],
                    'author_id' => $author->id,
                ]
            );
        }
     }
}
