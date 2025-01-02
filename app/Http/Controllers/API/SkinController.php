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
        if ($user && isset($user->skin)) {
            $skinPath = $user->getSkinPathAttribute();
        }
        if ($request->input('to_string') === 'true') {
            return $skinPath;
        }
        return response()->file(public_path($skinPath));
    }

    public function getCape(string $username)
    {
        return null;
    }
}
