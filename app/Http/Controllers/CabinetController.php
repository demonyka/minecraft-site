<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CabinetController extends Controller
{
    public function uploadSkin(Request $request)
    {
        // Валидация файла
        $request->validate([
            'skin' => 'required|image|mimes:png|max:2048', // Только изображения PNG до 2MB
        ]);

        $user = auth()->user();

        // Проверяем, существует ли файл в запросе
        if ($request->hasFile('skin')) {
            $file = $request->file('skin');

            $filePath = 'skins/' . $user->username . '/' . now() . '.png';

            Storage::disk('public')->put($filePath, file_get_contents($file));

            $user->skin_path = '/storage/' . $filePath;
            $user->save();

            return response()->json([
                'path' => $user->skin_path,
            ]);
        }

        // Если файл не был загружен
        return response()->json(['message' => 'No skin file uploaded'], 400);
    }
}
