<?php

namespace Tests\Feature;

use App\Models\Car;
use App\Models\User;
use Tests\TestCase;

class PickCarTest extends TestCase
{
    public function testPick()
    {
        $user = User::factory()->create();

        $car = Car::factory()->create();

        $response = $this->actingAs($user)->patch(route('car-pick', $car));


        $response->assertOk();
    }
}
