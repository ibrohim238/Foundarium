<?php

namespace Http\Controllers;

use App\Models\Car;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;
use function route;

class CarTest extends TestCase
{
    use WithFaker;

    public function testIndex()
    {
        $car = Car::factory()->create();

        $response = $this->getJson(route('cars.index'));

        $response
            ->assertOk()
            ->assertJsonFragment([
                    'data' => [
                        [
                            'id' => $car->id,
                            'name' => $car->name,
                            'created_at' => $car->created_at,
                        ]
                    ],
                ]
            );
    }

    public function testShow()
    {
        $car = Car::factory()->create();

        $response = $this->getJson(route('cars.show', $car));

        $response
            ->assertOk()
            ->assertJsonFragment([
                    'data' => [
                        'id' => $car->id,
                        'name' => $car->name,
                        'user' => null,
                        'created_at' => $car->created_at,
                    ],
                ]
            );
    }

    public function testShowNotFound()
    {
        $response = $this->getJson(route('cars.show', 'n'));

        $response->assertNotFound();
    }

    public function testStoreOk()
    {
        $response = $this->postJson(route('cars.store', [
            'name' => $this->faker->name
        ]));

        $response->assertCreated();
    }

    public function testStoreErrorValidateName()
    {
        $response = $this->postJson(route('cars.store', [
            'name' => Str::random(26)
        ]));

        $response
            ->assertUnprocessable()
            ->assertJsonValidationErrors('name');
    }

    public function testUpdate()
    {
        $car = Car::factory()->create();

        $response = $this->patchJson(route('cars.update', $car), [
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

    public function testUpdateNotFound()
    {
        $response = $this->patchJson(route('cars.update', 'n'), [
            'name' => 'updated'
        ]);

        $response->assertNotFound();
    }

    public function testDelete()
    {
        $car = Car::factory()->create();

        $response = $this->deleteJson(route('cars.destroy', $car));

        $response->assertNoContent();
    }

    public function testDeleteNotFound()
    {
        $response = $this->deleteJson(route('cars.destroy', 'n'));

        $response->assertNotFound();
    }
}
