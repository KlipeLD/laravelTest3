<?php

namespace Database\Factories;

use App\Models\Articles;
use App\Models\Comments;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comments::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $userIds = User::pluck('id')->toArray();
        $ids = Articles::pluck('id')->toArray();
        $fakeDate = $this->faker->date('Y-m-d','now');
        return [
            'articles_id' =>  $this->faker->randomElement($ids),
            'user_id' => $this->faker->randomElement($userIds),
            'subject' => $this->faker->sentence,
            'body' => $this->faker->paragraph,
            'created_at' => $fakeDate,
            'updated_at' => $fakeDate
        ];
    }
}
