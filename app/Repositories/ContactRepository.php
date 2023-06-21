<?php

namespace App\Repositories;

use App\Models\Contact;
use App\Models\User;

class ContactRepository
{
    public function save(array $data): Contact
    {
        return Contact::create($data);
    }

    public function findUser(Contact $contact, User $user): Contact|null
    {
        return $user->contacts()->find($contact->id);
    }

    /**
     * @throws \Throwable
     */
    public function update(array $data, Contact $contact, User $user): bool
    {
        $contact = $this->findUser($contact, $user);
        if(null === $contact) {
            return  false;
        }

        return $contact->updateOrFail($data);
    }

    public function delete(Contact $contact): ?bool
    {
        return $contact->delete();
    }
}
