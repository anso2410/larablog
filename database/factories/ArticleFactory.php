<?php

namespace Database\Factories;

use App\Models\Articles;
use App\Models\User;
use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
   
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id'=>User::factory(),
            'title'=> $title = $this->faker->sentence,
            'slug'=>Str::slug($title),
            'content'=>$this->faker->paragraph,
        ];
    }
}
