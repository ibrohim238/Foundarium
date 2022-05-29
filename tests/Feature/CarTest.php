<?php

namespace Tests\Feature;

use App\Models\Car;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class CarTest extends TestCase
{
    use WithFaker;

    public function testIndex()
    {
        $response = $this->getJson(route('car.index'));

        $response->assertOk();
    }

    public function testShowOk()
    {
        $car = Car::factory()->create([
            'name' => 'testing'
        ]);

        $response = $this->getJson(route('car.show', $car));

        $response
            ->assertOk()
            ->assertJson([
                    'data' => [
                        'name' => 'testing',
                    ],
                ]
            );
    }

    public function testShowNotFound()
    {
        $response = $this->getJson(route('car.show', 'n'));

        $response->assertNotFound();
    }

    public function testCreate()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->postJson(route('car.create-or-update', [
            'name' => $this->faker->name
        ]));

        $response->assertCreated();
    }

    public function testUpdate()
    {
        $car = Car::factory()->create();
        $user = $car->user;

        $response = $this->actingAs($user)->postJson(route('car.create-or-update', [
            'name' => 'updated',
        ]));

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
        $user = User::factory()->create();

        $response = $this->actingAs($user)->postJson(route('car.create-or-update', [
            'name' => Str::random(26)
        ]));

        $response
            ->assertJsonValidationErrors('name')
            ->assertUnprocessable();
    }

    public function testValidationFailedAuthorize()
    {
        $response = $this->postJson(route('car.create-or-update', [
            'name' => $this->faker->name,
        ]));

        $response->assertUnauthorized();
    }

    public function testDestroy()
    {
        $car = Car::factory()->create();
        $user = $car->user;

        $response = $this->actingAs($user)
            ->deleteJson(route('car.destroy'));

        $response->assertNoContent();
    }
}
