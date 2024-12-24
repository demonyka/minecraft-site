<?php

namespace App\Http\Requests\Auth;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class RegisterRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'username' => 'required|unique:users,username|min:4|max:16',
            'password' => 'required|min:6|max:64|confirmed',
        ];
    }

    public function register(): void
    {
        $user = new User();
        $user->username = $this->input('username');
        $user->email = $this->input('email');
        $user->password = Hash::make($this->input('password'));
        $user->save();
    }

    public function authorize(): bool
    {
        return true;
    }
}
