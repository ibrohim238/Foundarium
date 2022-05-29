<?php

namespace App\Swagger\Models;

use Carbon\Carbon;
use OpenApi\Attributes as OA;

#[OA\Schema(
    title: 'Notebook',
    description: 'Notebook model',
    xml: new OA\Xml(
        name: 'Notebook'
    )
)]
class Car
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
        title: "Created at",
        description: "Created at",
        type: "string",
        format: "datetime",
        example: "2020-01-27 17:50:45",
    )]
    private Carbon $created_at;

    #[OA\Property(
        title: "Updated at",
        description: "Updated at",
        type: "string",
        format: "datetime",
        example: "2020-01-27 17:50:45",
    )]
    private Carbon $updated_at;
}
