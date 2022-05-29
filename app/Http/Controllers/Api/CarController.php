<?php

namespace App\Http\Controllers\Api;

use App\Dto\CarDto;
use App\Http\Requests\CarRequest;
use App\Http\Resources\CarCollection;
use App\Http\Resources\CarResource;
use App\Models\Car;
use App\Services\CarService;
use App\Swagger\Responses\NotFoundResponse;
use App\Swagger\Responses\UnprocessableEntityResponse;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;
use function app;
use function response;

class CarController
{
    #[OA\Get(
        '/api/cars',
        description: 'Список машин',
        summary: 'Список машин',
        tags: ['Cars'],
        parameters: [
            new OA\Parameter(
                name: 'page',
                in: 'path',
                required: false,
                schema: new OA\Schema(type: 'integer'),
            ),
            new OA\Parameter(
                name: 'count',
                in: 'path',
                required: false,
                schema: new OA\Schema(type: 'integer'),
            )
        ]
    )]
    #[OA\Response(
        response: 200,
        description: 'OK',
        content: new OA\JsonContent(ref: "#/components/schemas/CarResource")
    )]
    public function index(Request $request): CarCollection
    {
        $cars = Car::query()->paginate($request->get('count'));

        return new CarCollection($cars);
    }

    #[OA\POST(
        '/api/cars',
        description: 'Добавить машин',
        summary: 'Добавить машин',
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(ref: '#/components/schemas/CarRequest'),
        ),
        tags: ['Cars'],
    )]
    #[OA\Response(
        response: 201,
        description: 'OK',
        content: new OA\JsonContent(ref: "#/components/schemas/Car")
    )]
    #[UnprocessableEntityResponse]
    public function show(Car $car): CarResource
    {
        return new CarResource($car->load('user'));
    }

    #[OA\Get(
        '/api/cars/{id}',
        description: 'Страница машины',
        summary: 'Страница машины',
        tags: ['Cars'],
        parameters: [
            new OA\Parameter(
                name: 'id',
                in: 'path',
                required: true,
                schema: new OA\Schema(type: 'integer'),
                example: 1,
            )
        ],
    )]
    #[OA\Response(
        response: 200,
        description: 'OK',
        content: new OA\JsonContent(ref: "#/components/schemas/Car")
    )]
    #[NotFoundResponse]
    public function store(CarRequest $request)
    {
        $car = app(CarService::class)->create(CarDto::fromRequest($request));

        return new CarResource($car);
    }

    #[OA\Patch(
        '/api/cars/{id}',
        description: 'Обновление машины',
        summary: 'Обновление машины',
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(ref: '#/components/schemas/CarRequest'),
        ),
        tags: ['Cars'],
        parameters: [
            new OA\Parameter(
                name: 'id',
                in: 'path',
                required: true,
                schema: new OA\Schema(type: 'integer'),
                example: 1,
            ),
        ],
    )]
    #[OA\Response(
        response: 200,
        description: 'OK',
        content: new OA\JsonContent(ref: "#/components/schemas/Car")
    )]
    #[NotFoundResponse]
    #[UnprocessableEntityResponse]
    public function update(Car $car, CarRequest $request)
    {
        $car = app(CarService::class, ['car' => $car])->update(CarDto::fromRequest($request));

        return new CarResource($car);
    }

    #[OA\Delete(
        '/api/cars/{id}',
        description: 'Удаление машины',
        summary: 'Удаление машины',
        tags: ['Cars'],
        parameters: [
            new OA\Parameter(
                name: 'id',
                in: 'path',
                required: true,
                schema: new OA\Schema(type: 'integer'),
            ),
        ]
    )]
    #[OA\Response(
        response: 204,
        description: 'OK',
        content: new OA\JsonContent()
    )]
    #[NotFoundResponse]
    public function destroy(Car $car)
    {
        app(CarService::class, ['car' => $car])->delete();

        return response()->noContent();
    }
}
