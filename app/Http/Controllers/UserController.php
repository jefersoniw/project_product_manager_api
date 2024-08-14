<?php

namespace App\Http\Controllers;

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
    public function show() {}
    public function store() {}
    public function update() {}
    public function delete() {}
}
