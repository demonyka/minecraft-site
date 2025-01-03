<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CabinetController extends Controller
{
    public function uploadSkin(Request $request)
    {
        $request->validate([
            'skin' => 'required|image|mimes:png|max:2048',
        ]);

        $user = auth()->user();

        $file = $request->file('skin');

        $user->uploadSkin($file);

        return response()->json([
            'path' => $user->skin_path,
        ]);
    }
}
