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

    public function userSaveService(array $data): JsonResponse
    {
        $token = $this->repository->save($data)
        ->createToken('user_token')->plainTextToken;

        return $this->sendResponse([
            'token' => $token
        ], 'Usuário criado com sucesso');
    }

    public function login(array $data): JsonResponse
    {
        if(! Auth::attempt($data)) {
            return $this->sendError('Credenciais invalidas!', 422);
        }

        $token = Auth::user()->createToken('user_token')->plainTextToken;

        return $this->sendResponse(['token' => $token], 'Usuário logado com sucesso');
    }
}
