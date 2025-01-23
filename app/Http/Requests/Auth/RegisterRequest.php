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
            'email' => 'required|email|unique:users,email|max:255',
            'password' => 'required|min:6|max:64|confirmed',
            'referal' => 'nullable|exists:users,username',
        ];
    }

    public function register(): void
    {
        $user = new User();
        $user->username = $this->input('username');
        $user->email = $this->input('email');
        $user->password = Hash::make($this->input('password'));

        if ($this->input('referal')) {
            $referal = User::where('username', $this->input('referal'))->first();
            if ($referal) {
                $user->referal_id = $referal->id;
            }
        }

        $user->save();
    }

    public function authorize(): bool
    {
        return true;
    }
}
