<?php

namespace App\Dto;

use App\Http\Requests\CarRequest;
use Spatie\DataTransferObject\DataTransferObject;

class CarDto extends DataTransferObject
{
    public string $name;

    public static function fromRequest(CarRequest $request): CarDto
    {
        return new self($request->validated());
    }
}
