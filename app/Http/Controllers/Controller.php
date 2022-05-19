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
 * @OA\Server(
 *     description="Laravel swagger API server",
 *     url="http://localhost:8035/api",
 * )
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
