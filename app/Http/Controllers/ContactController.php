<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateContactRequest;
use App\Http\Requests\UpdateContactRequest;
use App\Http\Resources\ContactResource;
use App\Models\Contact;
use App\Services\ContactService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Throwable;

class ContactController extends Controller
{
    private mixed $user;

    public function __construct(protected ContactService $service)
    {
        $this->user =  auth('sanctum')->user();
    }

    public function index(): AnonymousResourceCollection
    {
        return ContactResource::collection($this->contactPaginate());
    }

    public function store(CreateContactRequest $request): AnonymousResourceCollection
    {
         $this->service->create($request->all(), $this->user);

        return ContactResource::collection($this->contactPaginate());
    }

    public function show(Contact $contact): ContactResource
    {
        $contact = $this->service->show($contact, $this->user);

        return new ContactResource($contact);
    }

    /**
     * @throws Throwable
     */
    public function update(UpdateContactRequest $request, Contact $contact): ContactResource
    {
        $contact = $this->service->update($request->all(), $contact, $this->user);

        return new ContactResource($contact);
    }

    public function destroy(Contact $contact): AnonymousResourceCollection
    {
        $this->service->delete($contact, $this->user);

        return ContactResource::collection($this->contactPaginate());
    }

    private function contactPaginate()
    {
        return $this->user
            ->contacts()
            ->simplePaginate();
    }
}
