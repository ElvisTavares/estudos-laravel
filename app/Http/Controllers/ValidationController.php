<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ValidationController extends Controller
{
    public function showForm()
    {
        return view('login');
    }

    public function validateForm(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|max:8',
            'password' => 'required', 
        ]);
    }
}
