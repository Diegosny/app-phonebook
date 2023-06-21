<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateContactRequest;
use App\Http\Requests\UpdateContactRequest;
use App\Http\Resources\ContactResource;
use App\Models\Contact;
use App\Services\ContactService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function __construct(protected ContactService $service)
    {
        //
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): ContactResource
    {
        return new ContactResource(auth()->user()->contacts);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateContactRequest $request): ContactResource
    {
        $contact = $this->service->create($request->all());

        return new ContactResource($contact);
    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact): ContactResource
    {
        return new ContactResource($contact);
    }

    /**
     * Update the specified resource in storage.
     * @throws \Throwable
     */
    public function update(UpdateContactRequest $request, Contact $contact): ContactResource
    {
        $contact = $this->service->update($request->all(), $contact);

        return new ContactResource($contact);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact): ContactResource
    {
        $this->service->delete($contact);

        return new  ContactResource(auth()->user()->contacts);
    }
}
