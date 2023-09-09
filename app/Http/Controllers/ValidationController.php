<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;

class ValidationController extends Controller
{
    public function showForm()
    {
        return view('login');
    }

    public function validateForm(UserRequest $request)
    {
        dd($request);
    }
}
