<?php

namespace App\Http\Controllers;

use App\Http\Resources\User\UserResource;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function me(Authenticatable $authenticatable)
    {
        return UserResource::make($authenticatable);
    }

    public function update(Request $request, Authenticatable $authenticatable)
    {
        $file = $request->file('avatar')->store($authenticatable->getAuthIdentifier());
    }
}
