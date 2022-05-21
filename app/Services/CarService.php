<?php

namespace App\Services;

use App\Dto\CarDto;
use App\Models\Car;
use App\Models\User;

class CarService
{
    public function __construct(
      public Car $car
    ) {
    }

    public function create(CarDto $dto): Car
    {
        $this->fill($dto)->save();

        return $this->car;
    }

    public function update(CarDto $dto): Car
    {
        $this->fill($dto)->save();

        return $this->car;
    }

    public function fill(CarDto $dto): static
    {
        $this->car->fill($dto->toArray());

        return $this;
    }

    public function save(): static
    {
        $this->car->save();

        return $this;
    }

    public function delete(): void
    {
        $this->car->delete();
    }
}
