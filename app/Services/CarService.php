<?php

namespace App\Services;

use App\Dto\CarDto;
use App\Models\User;

class CarService
{
    public function __construct(
      public User $user
    ) {
    }

    public function createOrUpdate(CarDto $dto): void
    {
        $this->user->car()->updateOrCreate([], $dto->toArray());
    }

    public function delete(): void
    {
        $this->user->car()->delete();
    }
}
