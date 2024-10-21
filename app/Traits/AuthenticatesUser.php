<?php


namespace App\Traits;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

trait AuthenticatesUser
{

    public function validateLogin(LoginRequest $request, $user)
    {
        if (! $user || ! Hash::check($request->input('password'), $user->password ?? null)) {
            throw ValidationException::withMessages(['email' => 'Incorrect email or password!']);
        }
    }

    public function createAuthToken($user)
    {
        return $user->createToken('apiToken')->plainTextToken;
    }
}
