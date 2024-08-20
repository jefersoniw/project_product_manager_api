<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\UserResource;
use App\Http\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(protected UserService $userService) {}

    /**
     * @OA\GET(
     *     path="/api/users",
     *     tags={"/Users"},
     *     summary="All Users",
     *     description="Show all registered users.",
     *     security={ {"bearerToken":{}} },
     *  @OA\Response(
     *    response=200,
     *    description="Show all users",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Show all users!")
     *    )
     *  ),
     *  @OA\Response(
     *    response=401,
     *    description="Unauthenticated",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Unauthenticated"),
     *    )
     *  ),
     * )
     */
    public function index()
    {
        return UserResource::collection($this->userService->allUsers());
    }

    /**
     * @OA\GET(
     *     path="/api/users/{id}",
     *     tags={"/Users"},
     *     summary="Show details user",
     *     description="Show details user.",
     *     security={ {"bearerToken":{}} },
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Id User",
     *         required=true,
     *     ),  
     *     @OA\Response(
     *         response=200,
     *         description="Show details user",
     *     @OA\JsonContent(
     *        @OA\Property(property="message", type="string", example="Show details user!")
     *     )
     *  ),
     * @OA\Response(
     *    response=401,
     *    description="Unauthenticated",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Unauthenticated"),
     *    )
     *  ),
     * )
     */
    public function show($id)
    {
        return new UserResource($this->userService->detailsUser($id));
    }

    /**
     * @OA\POST(
     *  tags={"/Users"},
     *  summary="Creating a new user.",
     *  description="Creating a new user.",
     *  path="/api/users/",
     *  security={ {"bearerToken":{}} },
     *  @OA\RequestBody(
     *      @OA\MediaType(
     *          mediaType="application/json",
     *          @OA\Schema(
     *                 @OA\Property(
     *                     property="name",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="email",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="password",
     *                     type="string"
     *                 ),
     *                 example={"name": "teste1", "email": "email@email.com", "password": "password"}
     *          )
     *      ),
     *  ),
     *  @OA\Response(
     *         response=201,
     *         description="User created!",
     *     @OA\JsonContent(
     *        @OA\Property(property="message", type="string", example="user created!")
     *     )
     *  ),
     *  @OA\Response(
     *    response=401,
     *    description="Unauthenticated",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Unauthenticated"),
     *    )
     *  ),
     *  @OA\Response(
     *      response=422,
     *      description="Incorrect fields",
     *      @OA\JsonContent(
     *         @OA\Property(property="message", type="string", example="Incorrect fields"),
     *         @OA\Property(property="errors", type="string", example="..."),
     *      )
     *   )
     * )
     */
    public function store(UserStoreRequest $request)
    {
        return new UserResource($this->userService->registerUser($request));
    }

    /**
     * @OA\PUT(
     *  tags={"/Users"},
     *  summary="Updating user.",
     *  description="Updating user.",
     *  path="/api/users/{id}",
     *  security={ {"bearerToken":{}} },
     *  @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Id user",
     *         required=true,
     *  ),
     *  @OA\RequestBody(
     *      @OA\MediaType(
     *          mediaType="application/json",
     *          @OA\Schema(
     *                 @OA\Property(
     *                     property="name",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="email",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="password",
     *                     type="string"
     *                 ),
     *                 example={"name": "teste1", "email": "email@email.com", "password": "password"}
     *          )
     *      ),
     *  ),
     *  @OA\Response(
     *         response=200,
     *         description="User updated!",
     *     @OA\JsonContent(
     *        @OA\Property(property="message", type="string", example="user updated!")
     *     )
     *  ),
     *  @OA\Response(
     *    response=401,
     *    description="Unauthenticated",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Unauthenticated"),
     *    )
     *  ),
     *  @OA\Response(
     *      response=422,
     *      description="Incorrect fields",
     *      @OA\JsonContent(
     *         @OA\Property(property="message", type="string", example="Incorrect fields"),
     *         @OA\Property(property="errors", type="string", example="..."),
     *      )
     *   )
     * )
     */
    public function update(UserUpdateRequest $request, $id)
    {
        return new UserResource($this->userService->editUser($request, $id));
    }

    /**
     * @OA\DELETE(
     *  tags={"/Users"},
     *  summary="Delete user!",
     *  description="Delete user!",
     *  path="/api/users/delete/{id}",
     *  security={ {"bearerToken":{}} },
     *  @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Id user",
     *         required=true,
     *  ),
     *  @OA\Response(
     *    response=200,
     *    description="User deleted!",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="User deleted!")
     *    )
     *  ),
     *  @OA\Response(
     *    response=401,
     *    description="Unauthenticated",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Unauthenticated"),
     *    )
     *  )
     * )
     */
    public function delete($id)
    {
        return response()->json($this->userService->deleteUser($id));
    }
}
