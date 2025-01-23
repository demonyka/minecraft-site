<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\UploadedFile;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

/**
 * @property string $skin_path
 * @property int $balance
 * @property int $referal_id
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uuid',
        'username',
        'email',
        'balance',
        'password',
        'skin_path',
        'referal_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime',
    ];

    public function uploadSkin(UploadedFile $file): void
    {
        if ($file->getClientOriginalExtension() !== 'png') {
            throw new \InvalidArgumentException('Файл должен быть в формате PNG.');
        }

        $mimeType = $file->getMimeType();
        if ($mimeType !== 'image/png') {
            throw new \InvalidArgumentException('Файл должен быть в формате PNG.');
        }

        $imageSize = getimagesize($file->getPathname());
        if (!($imageSize[0] === 64 && ($imageSize[1] === 32 || $imageSize[1] === 64))) {
            throw new \InvalidArgumentException('Размер изображения должен быть 64x32 или 64x64.');
        }

        $filePath = 'skins/' . $this->username . '/' . now()->timestamp . '.png';

        Storage::disk('public')->put($filePath, file_get_contents($file->getPathname()));

        $this->skin_path = '/storage/' . $filePath;
        $this->save();
    }

    public function addBalance(float $amount): void
    {
        $this->balance += $amount;
        $this->save();
    }
}
