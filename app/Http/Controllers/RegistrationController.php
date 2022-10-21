<?php

namespace App\Http\Controllers;

use App\Dto\UserDto;
use App\Resources\UserResource;
use App\Services\UserService;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function __invoke(Request $request, UserService $userService)
    {
        $this->validate($request, [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'phone' => 'required|string|unique:users',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string'
        ]);

        $user = $userService->create(
            UserDto::createFromRequest($request)
        );

//        event(Registered::class);

        return new UserResource($user);
    }
}
