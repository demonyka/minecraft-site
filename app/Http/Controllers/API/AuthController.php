<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');

        $user = User::where('username', $username)->first();

        if (!$user || !Hash::check($password, $user->password)) {
            echo "Неверный логин или пароль";
            return;
        }

        if (!$user->whitelisted_until || $user->whitelisted_until < now()) {
            echo "У вас нет действующей проходки";
            return;
        }

        echo "OK:$username";
    }
}
