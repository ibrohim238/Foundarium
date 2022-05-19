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
        $response = $this->get(route('car.index'));

        $response->assertOk();
    }

    public function testShow()
    {
        $car = Car::factory()->create([
            'name' => 'testing'
        ]);

        $response = $this->get(route('car.show', $car));

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
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('car.create-or-update', [
            'name' => $this->faker->name
        ]));

        $response->assertCreated();
    }

    public function testUpdate()
    {
        $car = Car::factory()->create();
        $user = $car->user;

        $response = $this->actingAs($user)->post(route('car.create-or-update', [
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

        $response = $this->actingAs($user)->post(route('car.create-or-update', [
            'name' => Str::random(26)
        ]));

        $response
            ->assertStatus(302)
            ->assertSessionHasErrors('name');
    }

    public function testValidationFailedAuthorize()
    {
        $response = $this->post(route('car.create-or-update', [
            'name' => $this->faker->name,
        ]));

        $response->assertStatus(500);
//        $response->assertRedirect(route('login'));
    }

    public function testDestroy()
    {
        $car = Car::factory()->create();
        $user = $car->user;

        $response = $this->actingAs($user)
            ->delete(route('car.destroy'));

        $response->assertNoContent();
    }
}
