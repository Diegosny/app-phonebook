<?php

namespace App\Services;

use App\Models\Contact;
use App\Models\User;
use App\Repositories\ContactRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Throwable;

class ContactService
{
    public function __construct(protected ContactRepository $repository)
    {
        //
    }

    public function create(array $data): Contact
    {
        $data['user_id'] = auth()->user()->id;

        return $this->repository->save($data);
    }

    public function show(Contact $contact, User $user): Contact
    {
        $contact = $this->repository->findUser($contact, $user);

        if(null === $contact) {
            throw new ModelNotFoundException();
        }

        return $contact;
    }

    /**
     * @throws Throwable
     */
    public function update(array $data, Contact $contact, User $user): bool|Contact
    {
         $checkContact = $this->repository->update($data, $contact, $user);

         if(false === $checkContact) {
             throw new ModelNotFoundException();
         }

         return $contact->refresh();
    }

    public function delete(Contact $contact, User $user): ?bool
    {
        $contact = $this->repository->delete($contact, $user);

        if(false === $contact) {
            throw new ModelNotFoundException();
        }

        return $contact;
    }

}
