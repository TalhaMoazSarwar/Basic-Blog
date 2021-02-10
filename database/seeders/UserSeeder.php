<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Post;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()
            ->hasPosts(5)
            ->create([
                'name' => 'Talha Moaz Sarwar',
                'email' => 'iamtms@hotmail.com',
            ]);

        User::factory()
            ->has(
                Post::factory()
                    ->count(3)
            )
            ->count(4)
            ->create();
    }
}
