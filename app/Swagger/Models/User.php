<?php

namespace App\Swagger\Models;

use OpenApi\Attributes as OA;

#[OA\Schema(
    title: 'User',
    description: 'User model',
    xml: new OA\Xml(
        name: 'user'
    )
)]
class User
{
    #[OA\Property(
        title: 'id',
        description: 'id',
        format: 'int64',
        example: 1,
    )]
    private int $id;

    #[OA\Property(
        title: 'name',
        description: 'Название',
        example: 'Rachelle Homenick'
    )]
    public string $name;

    #[OA\Property(
        title: 'email',
        description: 'Почта',
        example: 'example@hotmail.com'
    )]
    public string $email;

    #[OA\Property(
        title: 'car_id',
        description: 'Car id',
        example: 1
    )]
    public int $car_id;
}
