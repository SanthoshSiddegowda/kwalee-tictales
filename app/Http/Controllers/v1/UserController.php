<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\FetchResource;
use App\Models\User;
use App\Models\UserAvatar;

class UserController extends Controller
{
    public function show($id): FetchResource
    {
        $user = User::whereId($id)->first();

        $user['avatars'] = UserAvatar::whereUserId($id)->orderBy('sequence')->get();

        return new FetchResource(
            $user
        );
    }
}
