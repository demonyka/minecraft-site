<?php

namespace App\Http\Controllers\API;

use App\Models\User;

class SkinController
{
    public function getSkin(string $username)
    {
        $user = User::where('username', $username)->first();
        if ($user && $user->skin_url) {
            $skinPath = $user->skin_url;
        } else {
            $skinPath = '/storage/skins/default.png';
        }

        return response()->file(public_path($skinPath));
    }

    public function getCape(string $username)
    {
        $user = User::where('username', $username)->first();

        if ($user && $user->cape_url) {
            $skinPath = $user->cape_url;
            return response()->file(public_path($skinPath));
        }

        return response('', 204);
    }
}
