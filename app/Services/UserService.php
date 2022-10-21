<?php

namespace App\Services;

use App\Dto\UserDto;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function create(UserDto $userDto): User
    {
        // some creating logic ...
        $user = new User();
        $user->first_name = $userDto->firstName;
        $user->last_name = $userDto->lastName;
        $user->phone = $userDto->phone;
        $user->email = $userDto->email;
        $user->password = Hash::make($userDto->password);
        $user->save();

        return $user;
    }

    public function updatePasswordByEmail($email, $password): void
    {
        // some update password logic
        User::query()->where('email', $email)->update([
            'password' => Hash::make($password),
            'api_token' => null
        ]);
    }
}
