<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct() {}

    /**
     * @OA\POST(
     *  tags={"JWT Authentication"},
     *  summary="Get a autentication user token",
     *  description="This endpoints return a new token user authentication for use on protected endpoints",
     *  path="/api/login",
     *  @OA\RequestBody(
     *      @OA\MediaType(
     *          mediaType="multipart/form-data",
     *          @OA\Schema(
     *              required={"email","password"},
     *              @OA\Property(property="email", type="string", example="jeferson_chagas@hotmail.com"),
     *              @OA\Property(property="password", type="string", example="password")
     *          )
     *      ),
     *  ),
     *  @OA\Response(
     *    response=200,
     *    description="Token generated",
     *    @OA\JsonContent(
     *       @OA\Property(property="access_token", type="string", example="eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0L2FwaS9sb2dpbiIsImlhdCI6MTcyNDEyNTA2OSwiZXhwIjoxNzI0MTI4NjY5LCJuYmYiOjE3MjQxMjUwNzAsImp0aSI6ImFUY1JnV010d004aGVVbzgiLCJzdWIiOiIxIiwicHJ2IjoiMjNiZDVjODk0OWY2MDBhZGIzOWU3MDFjNDAwODcyZGI3YTU5NzZmNyJ9.IIElpk0R-CirY8fO4svp6aJR6a1BUeCLS5C5ayPQVqo")
     *    )
     *  ),
     *  @OA\Response(
     *    response=422,
     *    description="Incorrect credentials",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="The provided credentials are incorrect."),
     *       @OA\Property(property="errors", type="string", example="..."),
     *    )
     *  )
     * )
     */
    public function login(LoginRequest $request)
    {
        $creds = $request->only(['email', 'password']);

        if (!$token = auth()->attempt($creds)) {
            return response()->json([
                'error' => 'Unauthorized'
            ], 401);
        }

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }

    /**
     * @OA\DELETE(
     *  tags={"JWT Authentication"},
     *  summary="Revoke all user tokens",
     *  description="This endpoint provides a logout for user, revoking all actived user tokens.",
     *  path="/api/logout",
     *  security={ {"bearerToken":{}} },
     *  @OA\Response(
     *    response=200,
     *    description="All user tokens revoked",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="All user tokens were revoked !")
     *    )
     *  ),
     *  @OA\Response(
     *    response=401,
     *    description="Unauthenticated",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Unauthenticated"),
     *    )
     *  ),
     *  @OA\Response(
     *    response=422,
     *    description="Incorrect fields",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="The email field is required."),
     *       @OA\Property(property="errors", type="string", example="..."),
     *    )
     *  )
     * )
     */
    public function logout(Request $request)
    {
        auth()->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }
}
