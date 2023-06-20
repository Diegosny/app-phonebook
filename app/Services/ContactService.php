<?php

namespace App\Services;

use App\Models\Contact;
use App\Repositories\ContactRepository;

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

    /**
     * @throws \Throwable
     */
    public function update(array $data, Contact $contact): Contact
    {
         $this->repository->update($data, $contact);

         return $contact->refresh();
    }

    public function delete(Contact $contact): ?bool
    {
        return $this->repository->delete($contact);
    }
}
