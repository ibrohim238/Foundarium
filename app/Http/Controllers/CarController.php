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
    /**
     * @OA\Get(
     *     path="/cars",
     *     operationId="carsAll",
     *     tags={"Cars"},
     *     summary="Car Index Page",
     *     @OA\Parameter(
     *         name="page",
     *         in="query",
     *         description="The page number",
     *         required=false,
     *         @OA\Schema(
     *             type="integer",
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="count",
     *         in="query",
     *         description="The page count",
     *         required=false,
     *         @OA\Schema(
     *             type="integer",
     *         )
     *     ),
     *     @OA\Response(
     *          response="200",
     *          description="Everything is fine"
     *     )
     * )
    */
    public function index(Request $request): CarCollection
    {
        $cars = Car::query()->paginate($request->get('count'));

        return new CarCollection($cars);
    }

    /**
     * @OA\Get(
     *     path="/cars/{id}",
     *     operationId="CarsGet",
     *     tags={"Cars"},
     *     summary="Get example by ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="The ID of example",
     *         required=true,
     *         example="1",
     *         @OA\Schema(
     *             type="integer",
     *         ),
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Everything is fine",
     *     ),
     * )
     */
    public function show(Car $car): CarResource
    {
        return new CarResource($car->load('user'));
    }

    /**
     * @OA\Post(
     *     path="/cars",
     *     operationId="carsCreateOrUpdate",
     *     tags={"Cars"},
     *     summary="CreateOrUpdate by User",
     *     @OA\Response(
     *         response="200",
     *         description="Everything is fine",
     *     ),
     * )
     */
    public function createOrUpdate(CarRequest $request)
    {
        $car = app(CarService::class, ['user' => Auth::user()])->createOrUpdate(CarDto::fromRequest($request));

        return new CarResource($car);
    }

    /**
     * @OA\Delete(
     *     path="/cars",
     *     operationId="CarsDelete",
     *     tags={"Cars"},
     *     summary="Delete example by User",
     *     @OA\Response(
     *         response="204",
     *         description="Deleted",
     *     ),
     * )
     */
    public function destroy()
    {
        app(CarService::class, ['user' => Auth::user()])->delete();

        return response()->noContent();
    }
}
