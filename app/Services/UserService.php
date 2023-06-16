<?php

namespace App\Services;

use App\Http\Resources\UserResource;
use App\Repositories\UserRepository;
use App\Traits\ResponseApiTrait;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class UserService
{
    use ResponseApiTrait;

    public function __construct(
        protected UserRepository $repository
    )
    {
        $this->repository = app(UserRepository::class);
    }

    public function create(array $data): UserResource
    {
        $data['password'] = bcrypt($data['password']);

        $user =  $this->repository->save($data);

        $user->token = $user->createToken('app_token')->plainTextToken;

        return new UserResource($user);
    }

    public function login(array $data): JsonResponse|Authenticatable
    {
        if(! Auth::attempt($data)){
            return $this->sendError('Não autorizado', 403);
        }

        $user = Auth::user();
        $user->token =  $user->createToken('app_token')->plainTextToken;

        return $user;
    }
}
