<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserAvatar>
 */
class UserAvatarFactory extends Factory
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
            'user_id' => 1,
            'item_id' => 1,
            'category_id' => 1,
            'quantity' => 1,
            'name' => 'Head_band',
            'image_url' => 'https://i.insider.com/501fde6feab8ea876c000002',
            'is_inventory' => 0,
        ];
    }
}
