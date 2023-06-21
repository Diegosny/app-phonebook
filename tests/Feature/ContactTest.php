<?php

namespace Tests\Feature;

use App\Models\Contact;
use App\Models\User;
use Tests\TestCase;

class ContactTest extends TestCase
{
    protected array $dataContacts = [];

    protected User $user;

    public function test_view_all_contacts()
    {
        $contact = $this->createContact(3);

        $this->actingAs($contact[0]->user, 'sanctum');

        $response = $this->get('/api/v1/contacts')
        ->assertStatus(200);

        $this->assertNotEmpty($response->json()['data']);
    }

    public function test_create_contact()
    {
        $this->setAttributesContact();
        $this->createUser();

        $response = $this->post('/api/v1/contacts', $this->dataContacts)
        ->assertStatus(200);

        $this->assertNotEmpty($response->json());
        $this->assertEquals($this->user->id, $response->json()['data'][0]['user_id']);
    }

    public function test_view_only_contact()
    {
        $contact = $this->createContact(1)[0];

        $this->actingAs($contact->user, 'sanctum');

        $response = $this->get("/api/v1/contacts/$contact->id")
        ->assertStatus(200);

        $this->assertNotEmpty($response->json()['data']);
        $this->assertCount(1, $response->collect());
    }

    public function test_update_contact()
    {
        $contact = $this->createContact(1)[0];
        $this->actingAs($contact->user, 'sanctum');

        $data = $this->setAttributesContact();

        $response = $this->put("/api/v1/contacts/$contact->id", $data)
        ->assertStatus(200);

        $this->assertNotEmpty($response->json()['data']);
        $this->assertNotEquals($contact->email, $response->json()['data']['email']);
    }

    public function test_delete_contact()
    {
        $contact = $this->createContact(1)[0];
        $this->actingAs($contact->user, 'sanctum');

        $response = $this->delete("/api/v1/contacts/$contact->id")
        ->assertStatus(200);

        $this->assertEmpty($response->json()['data']);
    }

    protected function createUser(): void
    {
        $this->user = User::factory(1)
            ->create()[0];

        $this->actingAs($this->user, 'sanctum');
    }

    protected function createContact(int $amount)
    {
        return Contact::factory($amount)
            ->create();
    }

    protected function setAttributesContact(): array
    {
        $faker = \Faker\Factory::create('pt_BR');

        return $this->dataContacts = [
            'first_name' => fake()->firstName,
            'last_name' => fake()->lastName,
            'email' => fake()->email,
            'phone' => $faker->phoneNumber()
        ];
    }
}
