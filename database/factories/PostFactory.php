<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Post;
use App\Models\User;



class PostFactory extends Factory
{
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
        
       'title'=>$this->faker->title,
        'description'=>$this->faker->text,
        'user_id'=>User::all()->random()->id,
        ];
    }
}
