<?php

namespace Database\Seeders;

use App\Models\AuthorBook;
use App\Models\Book;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(AuthorSeeder::class
        );
        Book::factory()->count(15)->create();
        AuthorBook::factory()->count(25)->create();
    }
}
