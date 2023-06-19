<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserLoginRequest;
use App\Http\Resources\UserResource;
use App\Services\UserService;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function __construct(
        protected UserService $service
    )
    {
        $this->service = app(UserService::class);
    }

    public function create(UserCreateRequest $request): JsonResponse
    {
        return $this->service->userSaveService($request->all());
    }

    public function login(UserLoginRequest $request): JsonResponse
    {
        return $this->service->login($request->all());
    }
}
