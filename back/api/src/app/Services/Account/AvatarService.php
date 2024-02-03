<?php

namespace App\Services\Account;

use App\Repositories\UserRepository;
use Creativeorange\Gravatar\Facades\Gravatar;
use Illuminate\Http\UploadedFile;

class AvatarService
{

    public function __construct(private UserRepository $userRepository, private AvatarStorageService $storageService)
    {
    }

    public function uploadAvatarFromContent(int $user_id, UploadedFile $file)
    {
        $this->storageService->putFromContent($user_id, $file->getContent());
    }
    public function uploadAvatarFromUrl(int $user_id, $url)
    {
        $this->storageService->storeAvatarFromUrl($user_id, $url);
    }
    public function createAvatar(int $user_id)
    {
        $user = $this->userRepository->findOrFail($user_id);

        $email = strtolower($user->email);

        if (Gravatar::exists($email)) {
            $url = Gravatar::get($email);
            $this->uploadAvatarFromUrl($user_id,$url);
        } else {
            $url = "https://www.gravatar.com/avatar/" . md5(trim($email)) . '?s=32&d=identicon&r=PG';
            $this->uploadAvatarFromUrl($user_id,$url);
        };
    }
}
