<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class SkinController extends Controller
{
    public function getSkin($username)
    {
        $skinPath = "skins/{$username}.png";
        $defaultSkinPath = "skins/default.png";

        // Check if the skin file exists
        if (Storage::exists($skinPath)) {
            // Return the skin file
            return response()->file(storage_path("app/{$skinPath}"));
        } else {
            // Return the default skin file
            return response()->file(storage_path("app/{$defaultSkinPath}"));
        }
    }

    public function getCloak($username)
    {
        $skinPath = "cloaks/{$username}.png";
        $defaultSkinPath = "cloaks/default.png";

        // Check if the skin file exists
        if (Storage::exists($skinPath)) {
            // Return the skin file
            return response()->file(storage_path("app/{$skinPath}"));
        } else {
            // Return the default skin file
            return response()->file(storage_path("app/{$defaultSkinPath}"));
        }
    }
}
