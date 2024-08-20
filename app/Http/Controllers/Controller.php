<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(
 *    title="API Gerenciamento de produtos",
 *    version="1.0.0",
 * ),
 *  @OA\SecurityScheme(
 *  type="http",
 *  description="Token obtido na autenticação",
 *  name="Authorization",
 *  in="header",
 *  scheme="bearer",
 *  bearerFormat="JWT",
 *  securityScheme="bearerToken"
 * )
 */

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}
