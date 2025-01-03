<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;

class SkinController
{
    public function getSkin(string $username, Request $request)
    {
        $user = User::where('username', $username)->first();
        $skinPath = '/storage/skins/default.png';
        if ($user && isset($user->skin_path)) {
            $skinPath = $user->skin_path;
        }
        return response()->file(public_path($skinPath));
    }

    public function getCape(string $username)
    {
        $user = User::where('username', $username)->first();
        if ($user && isset($user->cape_path)) {
            return response()->file(public_path($user->cape_path));
        }
    }
}
