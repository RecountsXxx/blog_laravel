<?php

namespace App\Services\Account;

use App\Repositories\User\UserRepository;
use Illuminate\Support\Facades\Storage;

class AvatarStorageService
{
    public function __construct(private UserRepository $userRepository)
    {
    }
    public function storeAvatarFromUrl(int $user_id, string $avatar_url)
    {
        $imageContent = file_get_contents($avatar_url);

        $path = $user_id . '/'  . 'original.webp';
        $url = asset(Storage::url('public/avatars/' . $user_id . '/original.webp'));

        $user = $this->userRepository->findOrFail($user_id);
        $this->userRepository->update($user,['avatar_url'=> $url]);

        Storage::disk('avatars')->put($path, $imageContent);
    }

    public function putFromContent(int $user_id, string $avatar_content)
    {
        $path = $user_id . '/'  . 'original.webp';
        $url = asset(Storage::url('public/avatars/' . $user_id . '/original.webp'));

        $user = $this->userRepository->findOrFail($user_id);
        $this->userRepository->update($user,['avatar_url'=> $url]);

        Storage::disk('avatars')->put($path, $avatar_content);
    }

}
