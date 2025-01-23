<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $username = $request->input('Login');
        $password = $request->input('Password');

        if (!$username || !$password) {
            return response()->json(["Message" => 'Все поля обязательны к заполнению'], 401);
        }

        $user = User::where('username', $username)->first();

        if (!$user || !Hash::check($password, $user->password)) {
            return response()->json(["Message" => "Неверный логин или пароль"], 401);
        }

        return response()->json(["Login" => $user->username, "UserUuid" => $user->uuid, "Message" => "Успешная авторизация"]);
    }

}
