<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Models\Callback;
use App\Models\User;


class CallbackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        

        // Create 500 callback records
        for ($i = 0; $i < 500; $i++) {
            Callback::create([
                'theme' => $faker->word,
                'message' => $faker->paragraph,
                'file' => $faker->optional()->image('public/uploads/', 640, 480, null, false),
                'created_at' => $faker->dateTimeInInterval('-24 hours'),
                'user_id' => User::all()->random()->id,
                
            ]);
        }
    }
}
