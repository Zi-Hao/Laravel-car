<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactsRequest;
use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Auth;

class ContactsController extends Controller
{
    public function index()
    {
        $user = Contact::query()->where('name',Auth::user()->name)->get();
        return view('contact.index',
            ['users' =>$user]);
    }

    public function create()
    {
        return view('contact.edit_create',
            ['contacts' => new Contact()]);
    }

    public function store()
    {
        $input = \Illuminate\Support\Facades\Request::all();
        Contact::create($input);

        return redirect()->route('contact.index');
    }
    public function edit(Contact $contacts)
    {
        return view('contact.edit_create', ['contacts' => $contacts]);
    }
}
