<?php

namespace App\Observers;

use App\Models\User;
use App\Models\UserExtend;

class UserObserver
{
    public function created(User $user): void
    {
        UserExtend::create([
            'user_id' => $user->id
        ]);
    }
}
