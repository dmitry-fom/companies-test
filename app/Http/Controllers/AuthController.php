<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    private const API_TOKEN_KEY = 'api_token';

    public function __construct(private AuthService $authService)
    {}

    public function getToken(Request $request): JsonResponse
    {
        $apiToken = $this->authService->retrieveApiTokenByCredentials(
            $request->get('email'),
            $request->get('password')
        );

        return response()->json([self::API_TOKEN_KEY => $apiToken]);
    }


    public function invalidateToken(Request $request)
    {
        $this->authService->unsetToken(
            $request->header('ApiToken')
        );

        return response('ok');
    }

    public function recoveryPasswordRequest(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|string'
        ]);

        $this->authService->sendRecoveryPasswordToken(
            $request->get('email')
        );

        return response('ok');
    }

    public function changePassword(Request $request)
    {
        $this->validate($request, [
            'token' => 'required|string',
            'password' => 'required|string',
        ]);

        $this->authService->changePassword(
            $request->get('token'),
            $request->get('password'),
        );

        return response('ok');
    }
}
