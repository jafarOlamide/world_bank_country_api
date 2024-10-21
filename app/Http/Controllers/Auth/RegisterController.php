<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Traits\AuthenticatesUser;
use App\Traits\RegistersUser;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    use RegistersUser, AuthenticatesUser;

    public function __invoke(RegisterRequest $request)
    {
        $user = $this->create($request->all());

        $token = $this->createAuthToken($user);

        return response()->json(['token' => $token, 'user' => $user], 201);
    }
}
