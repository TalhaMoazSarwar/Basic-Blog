<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $body = '';
        for ($i = 0; $i < rand(3, 6); $i++) {
            $body .= $this->faker->realText(rand(300, 900));
            $body .= '<br><br>';
        };

        return [
            'title' => $this->faker->realText(50),
            'body' => $body,
        ];
    }
}
