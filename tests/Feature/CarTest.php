<?php

namespace Tests\Feature;

use App\Models\Car;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class CarTest extends TestCase
{
    use WithFaker;

    public function testIndex()
    {
        $response = $this->get(route('cars.index'));

        $response->assertOk();
    }

    public function testShow()
    {
        $car = Car::factory()->create([
            'name' => 'testing'
        ]);

        $response = $this->get(route('cars.show', $car));

        $response
            ->assertOk()
            ->assertJson([
                    'data' => [
                        'name' => 'testing',
                    ],
                ]
            );
    }

    public function testCreate()
    {
        $response = $this->post(route('cars.store', [
            'name' => $this->faker->name
        ]));

        $response->assertCreated();
    }

    public function testUpdate()
    {
        $car = Car::factory()->create();

        $response = $this->patch(route('cars.update', $car), [
            'name' => 'updated'
        ]);

        $response
            ->assertOk()
            ->assertJson([
                    'data' => [
                        'name' => 'updated',
                    ],
                ]
            );
    }

    public function testValidationFailedName()
    {
        $response = $this->post(route('cars.store', [
            'name' => Str::random(26)
        ]));

        $response
            ->assertStatus(302)
            ->assertSessionHasErrors('name');
    }

    public function testDestroy()
    {
        $car = Car::factory()->create();

        $response = $this->delete(route('cars.destroy', $car));

        $response->assertNoContent();
    }
}
