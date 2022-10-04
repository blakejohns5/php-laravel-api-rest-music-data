<?php

namespace Tests\Feature;


use App\Models\Genre;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GenresApiTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_endpoint_artists_exists()
    {
        $response = $this->get('/api/artists');        
        $response->assertStatus(200);
    }

    public function test_endpoint_genres_exists()
    {
        $response = $this->get('/api/genres');        
        $response->assertStatus(200);
    }

    public function test_return_all_genres()
    {
        Genre::factory(100)->create();
        $response = $this->get('/api/genres'); 
        $response->assertJsonCount(100, 'genres');
        $response->assertStatus(200);
    }
}
