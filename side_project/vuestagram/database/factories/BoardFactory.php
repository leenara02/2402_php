<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Board>
 */
class BoardFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => 1,
            'content' => $this->faker->realText(rand(10, 50)),
            'img' => '/img/tigger'.rand(1,3).'.jpg',
            'like' => rand(1, 300),
        ];
    }
}
