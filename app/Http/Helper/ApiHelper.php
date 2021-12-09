<?php

namespace App\Http\Helper;

use Illuminate\Http\JsonResponse;

trait ApiHelper
{
    protected function isAdmin($user): bool
    {
        if(isset($user)) {
            return $user->tokenCan('admin');
        }

        return false;
    }

    protected function isAuthor($user): bool
    {
        if(isset($user)) {
            return $user->tokenCan('author');
        }

        return false;
    }

    protected function onSuccess($data, string $message = '', int $code = 200): JsonResponse
    {
        return response()->json([
            'status' => $code,
            'message' => $message,
            'data' => $data
        ], $code);
    }

    protected function onError(int $code, string $message = ''): JsonResponse
    {
        return response()->json([
            'status' => $code,
            'message' => $message
        ], $code);
    }

    protected function authorRegistrationValidationRules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ];
    }
}