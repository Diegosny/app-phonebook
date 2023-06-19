<?php

namespace App\Services;

use App\Mail\WelcomeUser;
use App\Repositories\UserRepository;
use App\Traits\ResponseApiTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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

        $this->sendEmail($data);

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

    private function sendEmail(array $data): void
    {
        Mail::to(
            data_get($data, 'email'),
            data_get($data, 'name')
        )->send(new WelcomeUser($data));
    }
}
