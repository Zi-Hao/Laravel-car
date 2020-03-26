<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;

class ownsController extends Controller
{
    public function index()
    {
        $user = student::query()->where('name',Auth::user()->name)->get();
        return view('own.index', ['users' => $user]);
    }
}
