<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserLoginRequest;
use App\Http\Resources\UserResource;
use App\Services\UserService;

class UserController extends Controller
{
    public function __construct(protected UserService $service)
    {
        //
    }

    public function create(UserCreateRequest $request): UserResource
    {
        $response =  $this->service->create($request->all());

        return new UserResource($response);
    }

    public function login(UserLoginRequest $request): UserResource
    {
        $response =  $this->service->login($request->all());

        return new UserResource($response);
    }
}
