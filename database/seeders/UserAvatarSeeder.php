<?php

namespace Database\Seeders;

use App\Models\UserAvatar;
use Illuminate\Database\Seeder;

class UserAvatarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserAvatar::factory(2)->create();
    }
}
