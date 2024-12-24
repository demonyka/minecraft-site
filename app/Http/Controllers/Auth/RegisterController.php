<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;

class RegisterController extends Controller
{
    public function store(RegisterRequest $request)
    {
        $request->register();

        return redirect()->route('auth.login')->with('success', 'Аккаунт зарегистрирован');
    }
}
