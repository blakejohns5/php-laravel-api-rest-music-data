<?php

namespace Tests\Feature;

use App\Models\Genre;
use App\Models\Artist;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GenreStructureTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $createdGenre = Genre::factory()->create();

        $response = $this->get('/api/genres');
        $returnedGenre = $response->json('genres')[0];

        $this->assertEquals($createdGenre->name, $returnedGenre['name']);
        $this->assertEquals($createdGenre->id, $returnedGenre['id']);
        $this->assertIsArray($returnedGenre['artists']);

        $artist = Artist::factory(10)->create([
            'genre_id' => $createdGenre->id,
        ]);

        $response = $this->get('/api/genres');
        $returnedGenre = $response->json('genres')[0];
        $this->assertIsArray($returnedGenre['artists']);
        $response->assertJsonCount(10, 'genres.0.artists');

        $response->assertStatus(200);
    }
}
