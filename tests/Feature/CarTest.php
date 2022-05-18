<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CarTest extends TestCase
{
    use WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testIndex()
    {
        $response = $this->get('/api/car');

        $response->assertOk();
    }

    public function testShow()
    {
        $response = $this->get('/api/car/2');

        $response->assertOk();
    }

    public function testStore()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->post('/api/car', [
           'name' => $this->faker->name
        ]);

        $response->assertOk();
    }

    public function testDestroy()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->delete('/api/car');

        $response->assertOk();
    }
}
