<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
//use Illuminate\Foundation\Testing\TestCase;
class LoginTest extends TestCase
{
   
    public function testRequiresEmailAndLogin()
    {
        $this->json('POST', '/auth/login')
            ->assertStatus(422)
            ->assertJson([
                'email' => ['The email field is required.'],
                'password' => ['The password field is required.'],
            ]);
    }


    public function testUserLoginsSuccessfully()
    {
        $user = factory(User::class)->create([
            'email' => 'testlog@user.com',
            'password' => bcrypt('123456789'),
        ]);

        $payload = ['email' => 'testlog@user.com', 'password' => '123456789'];

        $this->json('POST', '/auth/login', $payload)
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'email',
                    'created_at',
                    'updated_at',
                    
                ],
            ]);

    }
}

