<?php

namespace Tests\Feature;

use Illuminate\Validation\ValidationException;
use Tests\TestCase;

class UserCreateTest extends TestCase
{
    protected array $data = [];

    public function test_user_create()
    {
        $response = $this->post('api/v1/users',
            $this->setAttributes()
        )->assertStatus(200);

        $this->assertArrayHasKey('token', $response->json()['data']);
    }

    public function test_not_create_user_invalid_fields()
    {
        $this->expectException(\Illuminate\Validation\ValidationException::class);

        $response = $this->post('/api/v1/users/', [
            'name' => '',
            'email' => '',
            'password' => ''
        ]);

        $response->assertJsonValidationErrors(['name', 'email', 'password']);
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
