<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
class RegisterTest extends TestCase
{
    public function testsRegistersSuccessfully()
    {
      $user=[
            'name' => 'Molly',
            'email' => 'molly@toptal.com',
            'password' => '123456789',
        ];
           
//dd($user);
      $this->json('post', '/auth/registration', $user)
            ->assertStatus(201);
    }

}
