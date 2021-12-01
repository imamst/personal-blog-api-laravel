<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\User;

class UserStatusController extends Controller
{
    public function suspend(User $user)
    {
        $user->update([
            'status' => User::STATUS_SUSPENDED
        ]);

        return response()->json('User status updated successfully');
    }

    public function unsuspend(User $user)
    {
        $user->update([
            'status' => User::STATUS_ACTIVE
        ]);

        return response()->json('User status updated successfully');
    }
}
