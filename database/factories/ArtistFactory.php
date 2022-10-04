<?php

namespace Database\Factories;

use App\Models\Genre;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Artist>
 */
class ArtistFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'bio' => $this->faker->realTextBetween($minNbChars = 20, $maxNbChars = 200, $indexSize = 2),
            
        ];
    }
}
