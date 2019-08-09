<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
//use Illuminate\Foundation\Testing\TestCase;
class LoginTest extends TestCase
{
    public function testUserLoginsSuccessfully()
    {
        $payload = ['email' => 'norberto.pfeffer@simonis.com', 'password' => '123456789'];

         $this->json('POST', '/auth/login', $payload)
            ->assertStatus(200)
          ->assertJsonStructure([   
            'access_token',
            'token_type',
            'expires_in'   
           ]);

    }
}

