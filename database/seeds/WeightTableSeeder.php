<?php

use Illuminate\Database\Seeder;
use App\Weight;
use App\User;

class WeightTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         
    $faker = \Faker\Factory::create();
$users = User::all()->pluck('id')->toArray();

for ($i = 0; $i < 50; $i++) {
    $user_id = $faker->randomElement($users);
    }
    Weight::create([
        'user_id' => $user_id,
       'value' => $faker->randomNumber(2),
        'remark' => $faker->paragraph]
    );
    }
    }

