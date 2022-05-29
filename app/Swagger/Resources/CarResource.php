<?php

namespace App\Swagger\Resources;

use App\Swagger\Models\Car;

/**
 * @OA\Schema(
 *     title="CarResource",
 *     description="Car resource",
 *     @OA\Xml(
 *         name="CarResource"
 *     )
 * )
 */
class CarResource
{
    /**
     * @OA\Property(
     *     title="Data",
     *     description="Data wrapper"
     * )
     */
    private Car $data;
}
