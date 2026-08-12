<?php

namespace App\Service;

use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class ProfileService
{
    public function updateProfile(User $user, array $data, ?UploadedFile $photo)
    {
        if ($photo) {
            if ($user->profile_photo_path) {
                Storage::disk('public')->delete($user->profile_photo_path);
            }

            $path = $photo->store('profile-photos', 'public');
            $data['profile_photo_path'] = $path;
        }

        unset($data['photo']);

        $user->update($data);

        return $user;
    }
}
