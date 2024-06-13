<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Book;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
  public function run()
  {
    Book::create([
        'title' => 'Book 1',
        'author' => 'Author 1',
        'copies_available' => 5
    ]);

    Book::create([
        'title' => 'Book 2',
        'author' => 'Author 2',
        'copies_available' => 3
    ]);
  }
  
}
