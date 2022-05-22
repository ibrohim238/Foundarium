<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\OpenApi(
 *     @OA\Info(
 *         version="1.0.0",
 *         title="Foundation documentation",
 *         description="Demo Todo List Api",
 *     )
 * )
 * @OA\Tag(
 *      name="Cars",
 *      description="Car Pages",
 * )
 * @OA\Tag(
 *      name="Users",
 *      description="User Pages",
 * )
 * @OA\Server(
 *     description="Laravel swagger API server",
 *     url="http://localhost:8036/api",
 * )
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
