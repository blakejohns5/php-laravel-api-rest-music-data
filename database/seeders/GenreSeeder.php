<?php

namespace Database\Seeders;

use App\Models\Genre;
use App\Models\Artist;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $genres = Genre::factory(10)->create();
        foreach ($genres as $genre) {
            Artist::factory(15)->create([
                'genre_id' => $genre->id,
            ]);
        }
    }
}
