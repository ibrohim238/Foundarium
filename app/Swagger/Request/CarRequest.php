<?php

namespace App\Swagger\Request;

use OpenApi\Attributes as OA;

#[OA\Schema(
    title: "Car request",
    description: "Car request body data",
    required: ["name"],
    type: "object",
)]
class CarRequest
{
    #[OA\Property(
        title: "name",
        description: "name of the new Car",
        example: "A nice Car"
    )]
    public string $name;
}
