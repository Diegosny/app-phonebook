<?php

namespace App\Repositories;

use App\Models\Contact;

class ContactRepository
{
    public function save(array $data): Contact
    {
        return Contact::create($data);
    }

    /**
     * @throws \Throwable
     */
    public function update(array $data, Contact $contact): bool
    {
        return $contact->updateOrFail($data);
    }

    public function delete(Contact $contact): ?bool
    {
        return $contact->delete();
    }
}
