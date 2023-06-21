<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateContactRequest;
use App\Http\Requests\UpdateContactRequest;
use App\Http\Resources\ContactResource;
use App\Models\Contact;
use App\Services\ContactService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ContactController extends Controller
{
    public function __construct(protected ContactService $service)
    {
        //
    }

    public function index(): AnonymousResourceCollection
    {
        return ContactResource::collection(auth()->user()->contacts()->paginate());
    }

    public function store(CreateContactRequest $request): AnonymousResourceCollection
    {
         $this->service->create($request->all());

        return ContactResource::collection(auth()->user()->contacts()->paginate());
    }

    public function show(Contact $contact): ContactResource
    {
        $contact = $this->service->show($contact, auth()->user());

        return new ContactResource($contact);
    }

    /**
     * @throws \Throwable
     */
    public function update(UpdateContactRequest $request, Contact $contact): ContactResource
    {
        $contact = $this->service->update($request->all(), $contact, auth()->user());

        return new ContactResource($contact);
    }

    public function destroy(Contact $contact): AnonymousResourceCollection
    {
        $this->service->delete($contact);

        return ContactResource::collection(auth()->user()->contacts()->paginate());
    }
}
