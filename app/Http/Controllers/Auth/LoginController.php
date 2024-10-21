<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use App\Traits\AuthenticatesUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    use AuthenticatesUser;

    public function __invoke(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        $this->validateLogin($request, $user);

        $token = $this->createAuthToken($user);

        return response()->json(['user' => $user, 'token' => $token]);
    }
}
