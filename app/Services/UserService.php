<?php

namespace App\Services;

use App\Jobs\SendEmailJob;
use App\Jobs\TesteJob;
use App\Repositories\UserRepository;
use App\Traits\ResponseApiTrait;
use Illuminate\Support\Facades\Auth;

class UserService
{
    use ResponseApiTrait;

    public function __construct(protected UserRepository $repository)
    {
        //
    }

    public function create(array $data): array
    {
        $token = $this->repository->save($data)
        ->createToken('user_token')->plainTextToken;

        $this->sendEmail($data);

        return ['token' => $token];
    }

    private function sendEmail(array $data): void
    {
        SendEmailJob::dispatch($data);
    }

    public function login(array $data): array
    {
        abort_if(! Auth::attempt($data), 422, 'Credenciais invalidas!');

        return [
           'token' => Auth::user()->createToken('user_token')->plainTextToken
        ];
    }
}
