<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class UserLoginTest extends TestCase
{
    protected array $data = [];

    public function test_user_login()
    {
        $data = $this->createUser();

        $this->post('/api/v1/users/login', [
            'email' => $data['email'],
            'password' => $data['password']
        ])
        ->assertStatus(200);

        $this->assertTrue(auth()->check());
    }

    public function test_user_invalid_login()
    {
        $this->post('/api/v1/users/login', [
            'email' => fake()->email,
            'password' => fake()->password
        ])
            ->assertStatus(422);

        $this->assertFalse(auth()->check());
    }

    private function createUser(): array
    {
        $data = $this->setAttributes();
        User::factory(1)->create($data);

        return $data;
    }

    private function setAttributes(): array
    {
        return $this->data = [
          'name' => fake()->name(),
          'email' => fake()->email(),
          'password' => fake()->password(8, 15)
        ];
    }
}
