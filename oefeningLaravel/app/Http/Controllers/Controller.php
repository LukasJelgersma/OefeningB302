<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(
 *     version="1.0.0",
 *     title="Bookstore API",
 *     description="Bookstore API",
 *     @OA\Contact(
 *          email="lukas@b302.nl"
 *      ),
 *     @OA\License(
 *          name="MIT",
 *          url="https://opensource.org/licenses/MIT"
 *     )
 * )
 * @OA\Server(
 *     description="API Server",
 *     url="http://localhost:8000/api"
 * )
 * @OA\Tag(
 *     name="Books",
 *     description="API Endpoints of Books"
 * )
 * @OA\Tag(
 *     name="Authors",
 *     description="API Endpoints of Authors"
 * )
 * @OA\Tag(
 *     name="Genres",
 *     description="API Endpoints of Genres"
 * )
 * @OA\Tag(
 *     name="Auth",
 *     description="API Endpoints of Auth"
 * )
 *
 */
class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}
