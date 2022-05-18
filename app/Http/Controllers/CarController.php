<?php

namespace App\Http\Controllers;

use App\Dto\CarDto;
use App\Http\Requests\CarRequest;
use App\Http\Resources\CarCollection;
use App\Http\Resources\CarResource;
use App\Models\Car;
use App\Services\CarService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CarController
{
    public function index(Request $request): CarCollection
    {
        $cars = Car::query()->paginate($request->get('count'));

        return new CarCollection($cars);
    }

    public function show(Car $car): CarResource
    {
        return new CarResource($car->load('user'));
    }

    public function createOrUpdate(CarRequest $request)
    {
        app(CarService::class, ['user' => Auth::user()])->createOrUpdate(CarDto::fromRequest($request));
    }

    public function destroy()
    {
        app(CarService::class, ['user' => Auth::user()])->delete();
    }
}
