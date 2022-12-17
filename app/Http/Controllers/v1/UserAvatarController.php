<?php

namespace App\Http\Controllers\v1;

use App\Classes\v1\UserAvatarClass;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\UserAvatar\sequenceAvatarRequest;
use App\Http\Resources\SaveResource;

class UserAvatarController extends Controller
{
    public function sequence(sequenceAvatarRequest $request)
    {
        $userAvatar = new UserAvatarClass();
        $userAvatar = $userAvatar->addSequence($request->all());

        return new SaveResource([
            'message' => 'Sequence Saved successful.',
        ]);
    }
}
