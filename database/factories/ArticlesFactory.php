<?php

namespace Database\Factories;

use App\Models\Articles;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticlesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Articles::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->sentence;
        $fakeDate = $this->faker->date('Y-m-d h:m:s','now');
        $userIds = User::pluck('id')->toArray();
        return [
            'user_id' => $this->faker->randomElement($userIds),
            'title' => $title,
            'category' => '0',
            'slug' => str_slug($title),
            'short_body' => $this->faker->sentence,
            'body' => $this->faker->paragraph,
            'created_at' => $fakeDate,
            'updated_at' => $fakeDate
        ];
    }
}
