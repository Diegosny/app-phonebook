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

    public function create(UserCreateRequest $request): UserResource
    {
        return $this->service->create($request->all());
    }

    public function login(UserLoginRequest $request): Authenticatable|JsonResponse
    {
        return $this->service->login($request->all());
    }
}
