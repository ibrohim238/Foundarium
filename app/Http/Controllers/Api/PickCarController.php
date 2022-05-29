<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\UserException;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\Car;
use App\Models\User;
use App\Services\UserService;
use App\Swagger\Responses\NotFoundResponse;
use App\Swagger\Responses\UnprocessableEntityResponse;
use Illuminate\Auth\Access\AuthorizationException;
use function app;
use function response;
use OpenApi\Attributes as OA;

class PickCarController extends Controller
{
    #[OA\Patch(
        '/user/{user}/car-pick/{car}',
        description: 'Выбор машины',
        summary: 'Выбор машины',
        tags: ['Users'],
        parameters: [
            new OA\Parameter(
                name: 'user',
                in: 'path',
                required: true,
                schema: new OA\Schema(type: 'integer'),
                example: 1,
            ),
            new OA\Parameter(
                name: 'car',
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
        content: new OA\JsonContent(ref: "#/components/schemas/User")
    )]
    #[NotFoundResponse]
    public function __invoke(User $user, Car $car)
    {
        $this->authorize('pickCar', $user);

        try {
            app(UserService::class, ['user' => $user])->pickCar($car);
        } catch (UserException $exception) {
            return response($exception->getMessage(), 403);
        }

        return new UserResource($user);
    }
}
