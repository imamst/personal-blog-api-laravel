<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\UserResource;

class UserController extends Controller
{
    public function index()
    {
        return UserResource::collection(User::select('id', 'name', 'email', 'status')->get());
    }

    public function show(User $user)
    {
        return new UserResource($user);
    }
}
