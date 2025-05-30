<?php

namespace App\Http\Controllers;
use App\Services\ResponseService;
use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController {
    const TOKEN_NAME = 'Personal Access Token';
    const REGISTER_ERROR_BAG = 'register';
    const REGISTER_VALIDATION = [
        'name' => ['required', 'string'],
        'email' => ['required', 'string', 'unique:users'],
        'password' => ['required', 'string'],
        'c_password' => ['required', 'same:password'],
    ];

    const LOGIN_ERROR_BAG = 'login';
    const LOGIN_VALIDATION = [
        'email' => ['required', 'string', 'email'],
        'password' => ['required', 'string'],
        'remember_me' => ['boolean'],
    ];

    const TOKEN_TYPE = 'Bearer';

    /**
     * Create user
     *
     * @api POST /api/auth/register
     *
     * @body {
     *  "name":       "string",
     *  "email":      "string",
     *  "password":   "string",
     *  "c_password": "string"
     * }
     *
     * @param  Request $request
     *
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
     *
     * @author Kauan Morinel Calheiro <kauan.calheiro@universo.univates.br>
     *
     * @date 2024-12-18
     */
    public function register(Request $request) {
        try {
            $request->validateWithBag(
                self::REGISTER_ERROR_BAG,
                self::REGISTER_VALIDATION
            );

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);

            $expires = now()->addDay();

            return ResponseService::success(
                data: $this->generateUserTokenResponse($user, $expires),
                message: 'Successfully created user!',
                code: 201
            );
        } catch (Exception $e) {
            return ResponseService::error($e);
        }
    }

    public function login(Request $request) {
        try {

            $request->validateWithBag(
                self::LOGIN_ERROR_BAG,
                self::LOGIN_VALIDATION
            );

            $credentials = $request->only('email', 'password');

            if (!Auth::attempt($credentials)) {
                throw new Exception('Unauthorized', 401);
            }

            $user = Auth::user();
            $user->tokens()->delete();

            $expires = $request->remember_me ? now()->addMonth() : now()->addDay();

            return [
                'token' => $user->createToken(self::TOKEN_NAME, ['*'], $expires)->plainTextToken,
            ];
        } catch (Exception $e) {
            return ResponseService::error($e);
        }
    }

    public function user(Request $request) {
        try {
            return ResponseService::success(
                data: $this->generateUserTokenResponse($request->user())
            );
        } catch (Exception $e) {
            return ResponseService::error($e);
        }
    }

    public function logout(Request $request) {
        try {
            $request->user()->tokens()->delete();
            return ResponseService::success(data: [], message: 'Successfully logged out');
        } catch (Exception $e) {
            return ResponseService::error($e);
        }
    }

    private function generateUserTokenResponse(User $user) {
        return [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'roles' => $user->rolesList,
            'permissions' => $user->permissionsList,
        ];
    }
}
