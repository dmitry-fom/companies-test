<?php

namespace App\Services;

use App\Exceptions\UnauthorizedException;
use App\Models\PasswordRecovery;
use App\Models\User;
use App\Mail\RecoveryPassword;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthService
{
    public function __construct(private UserService $userService)
    {}

    public function sendRecoveryPasswordToken(string $email): void
    {
        /** @var User $user */
        $user = User::query()->where('email', $email)->first();

        $passwordRecovery = new PasswordRecovery();
        $passwordRecovery->email = $email;
        $passwordRecovery->token = Str::uuid();
        $passwordRecovery->save();

        Mail::to($user->email)->send(
            new RecoveryPassword($passwordRecovery->token)
        );
    }

    public function changePassword(string $token, string $newPassword): void
    {
        /** @var PasswordRecovery $recoveryPassword */
        $recoveryPassword = PasswordRecovery::query()->where('token', $token)->firstOrFail();

        $this->userService->updatePasswordByEmail($recoveryPassword->email, $newPassword);
        $recoveryPassword->delete();
    }

    public function retrieveApiTokenByCredentials(string $email, string $password): string
    {
        /** @var User $user */
        $user = User::query()->where('email', $email)->firstOrFail();

        if (Hash::check($password, $user->password)) {
            $apiToken = Str::random(60);

            $user->api_token = $apiToken;
            $user->saveQuietly();

            return $apiToken;
        }

        throw new UnauthorizedException();
    }

    public function unsetToken($apiToken): void
    {
        $user = User::query()->where('api_token', $apiToken)->firstOrFail();

        $user->update(['api_token' => null]);
    }
}
