<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    /**
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $credentials = $request->only(['username', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json([
                'error' => 'Unauthorized'
            ], 401);
        }

        if(auth()->user()->status != User::ACTIVE){
            return response()->json([
                'code' => CODE_ERROR,
                'message' => "Tài khoản đã bị xóa hoặc bị khóa"
            ], 401);
        }

        return \App\Helper::successResponseWithToken($token);
    }

    /**
     * @param RegisterRequest $request
     * @return JsonResponse
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        $user = User::create(
            [
                'name' => $request->input('name'),
                'username' => $request->input('username'),
                'email' => $request->input('email'),
                'password' => bcrypt($request->input('password')),
                'status' => User::ACTIVE,
                'avatar' => $request->input('avatar')
            ]
        );

        $user->assignRole(ROLE_MEMBER);

        return \App\Helper::successResponse($user);
    }


    /**
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        auth()->logout();
        return \App\Helper::successResponse("User successfully signed out");
    }

    /**
     * Refresh a token.
     *
     * @return JsonResponse
     */
    public function refresh(): JsonResponse
    {
        $token = auth()->refresh();
        return \App\Helper::successResponseWithToken($token);
    }
}
