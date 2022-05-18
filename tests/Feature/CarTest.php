<?php

namespace Tests\Feature;

use App\Models\Car;
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
        $car = Car::factory()->create([
            'name' => 'testing'
        ]);

        $response = $this->get('/api/car/' . $car->id);
        $response->assertSee('testing');
        $response->assertOk();
    }

    public function testCreate()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->post('/api/car', [
           'name' => $this->faker->name
        ]);

        $response->assertOk();
    }

    public function testUpdate()
    {
        $user = User::orderByDesc('id')->first();

        $this->actingAs($user);

        $response = $this->post('/api/car', [
            'name' => 'updated'
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
