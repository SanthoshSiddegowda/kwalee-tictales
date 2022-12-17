<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'uuid' => fake()->uuid,
            'category_id' => 1,
            'name' => fake()->randomElement([
                'Head Band',
                'Mask',
                'Tattoo',
            ]),
            'price' => fake()->randomElement([
                100,
                50,
                20,
                10,
            ]),
            'image_url' => 'https://i.insider.com/501fde6feab8ea876c000002',
        ];
    }
}
