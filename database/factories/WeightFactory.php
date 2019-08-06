<?php
use App\Weight;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of WeightFactory
 *
 * @author admin
 */

{
  $factory->define(App\Weight::class, function (Faker\Generator $faker) {
      $users = User::all()->pluck('id')->toArray();

for ($i = 0; $i < 50; $i++) {
    $user_id = $faker->randomElement($users);
    }
    return [
       'user_id' => $user_id,
       'value' => $faker->randomNumber(2),
        'remark' => $faker->paragraph];
});
}
