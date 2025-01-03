<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LauncherController extends Controller
{
    public function download(Request $request)
    {
        $platform = $request->input('platform', 'windows');

        $files = [
            'windows' => public_path('/storage/download/Launcher/MiNEON Launcher.exe'),
            'mac' => public_path('/storage/download/Launcher/Launcher.jar'),
            'linux' => public_path('/storage/download/Launcher/Launcher.jar'),
        ];

        if (!isset($files[$platform])) {
            return response()->json(['error' => 'Неизвестная платформа'], 400);
        }

        $filePath = $files[$platform];

        if (file_exists($filePath)) {
            return response()->download($filePath, basename($filePath));
        } else {
            return response()->json(['error' => 'Файл не найден'], 404);
        }
    }
}
