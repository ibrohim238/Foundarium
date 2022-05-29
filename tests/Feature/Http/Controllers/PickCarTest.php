<?php

namespace Http\Controllers;

use App\Models\Car;
use App\Models\User;
use Tests\TestCase;
use function route;

class PickCarTest extends TestCase
{
    public function testPick()
    {
        $user = User::factory()->create();

        $car = Car::factory()->create();

        $response = $this->actingAs($user)->patch(route('car-pick', [$user, $car]));

        $response->assertOk();
    }
}
