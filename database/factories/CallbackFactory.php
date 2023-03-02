<?php

namespace Database\Factories;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Callback>
 */
class CallbackFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $factory->define(App\Callback::class, function (Faker $faker) {
            return [
                'theme' => $faker->word,
                'message' => $faker->paragraph,
                'file' => $faker->optional()->image('public/storage/file', 640, 480, null, false),
                'created_at' => $faker->dateTimeInInterval('-24 hours'), // Add this line 
                'user_id' => $faker->randomNumber(), // Add this line
                'email' => $faker->safeEmail, // Add this line
              ];
        });
    }
}
