<?php

namespace App\Services;

use App\Exceptions\UserException;
use App\Models\Car;
use App\Models\User;

class UserService
{
    public function __construct(
        public User $user
    ) {
    }

    public function pickCar(Car $car): void
    {
        if(User::where('car_id', $car->id)->exists()) {
            throw UserException::carBusy();
        }

        $this->associateCar($car)->save();
    }

    public function associateCar(Car $car): static
    {
        $this->user->car()->associate($car);

        return $this;
    }

    public function save(): static
    {
        $this->user->save();

        return $this;
    }
}
