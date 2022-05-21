<?php

namespace App\Http\Controllers;

use App\Exceptions\UserException;
use App\Http\Resources\UserResource;
use App\Models\Car;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Auth\Access\AuthorizationException;

class PickCarController extends Controller
{
    /**
     * @OA\Patch(
     *     path="/user/{user}/car-pick/{car}",
     *     operationId="pickCar",
     *     tags={"Users"},
     *     summary="Pick car for user by ID",
     *     @OA\Parameter(
     *         name="user",
     *         in="path",
     *         description="The ID of User",
     *         required=true,
     *         example="1",
     *         @OA\Schema(
     *             type="integer",
     *         ),
     *     ),
     *     @OA\Parameter(
     *         name="car",
     *         in="path",
     *         description="The ID of Car",
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
     * @throws AuthorizationException
     */
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
