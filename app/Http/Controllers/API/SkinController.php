<?php

namespace App\Http\Controllers\API;

use App\Models\User;

class SkinController
{
    public function getSkin(string $username)
    {
        $user = User::where('username', $username)->first();
        $skinPath = '/storage/skins/default.png';
        if ($user && isset($user->skin)) {
            $skinPath = $user->skin->path;
        }

        return response()->file(public_path($skinPath));
    }
}
