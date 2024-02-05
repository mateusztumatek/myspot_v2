<?php

namespace App\Http\Controllers;

use App\Http\Resources\User\UserResource;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function me(Authenticatable $authenticatable)
    {
        return UserResource::make($authenticatable);
    }
}
