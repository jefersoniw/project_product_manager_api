<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Http\Resources\UserResource;
use App\Http\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(protected UserService $userService) {}
    public function index()
    {
        return UserResource::collection($this->userService->allUsers());
    }
    public function show($id)
    {
        return new UserResource($this->userService->detailsUser($id));
    }
    public function store(UserStoreRequest $request)
    {
        return new UserResource($this->userService->registerUser($request));
    }
    public function update() {}
    public function delete() {}
}
