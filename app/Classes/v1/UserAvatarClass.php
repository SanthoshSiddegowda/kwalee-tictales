<?php

namespace App\Classes\v1;

use App\Models\UserAvatar;

class UserAvatarClass
{
    public function addSequence(array $request): void
    {
        foreach ($request['items'] as $sequence => $item) {
            UserAvatar::where([
                'user_id' => $request['user_id'],
                'item_id' => $item,
            ])->update([
                'sequence' => $sequence,
            ]);
        }
    }
}
