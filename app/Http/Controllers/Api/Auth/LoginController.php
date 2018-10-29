<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class LoginController extends Controller
{
    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Login user.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        if ($request->has('token')) {
            try {
                JWTAuth::parseToken()->authenticate();
                return $this->userHasAuthenticate($request->only('token'));
            } catch (\Exception $e) {
                return $this->userFailedAuthenticate();
            }
        }

        $validation = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:3',
        ]);

        $credentials = $request->only('email', 'password');
        if ((!$token = $this->guard()->attempt($credentials)) || $validation->fails()) {
            return $this->userFailedAuthenticate();
        }

        return $this->userHasAuthenticate($token);
    }

    /**
     * Logout user.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    protected function logout(Request $request)
    {
        $this->guard()->logout();
        return response()->json([
            'status' => 'success',
            'msg' => 'Logged out Successfully.'
        ], 200);
    }

    /**
     * Get current authenticate user.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function user(Request $request)
    {
        $user = User::find(Auth::user()->id);
        return response()->json([
            'status' => 'success',
            'data' => $user
        ]);
    }

    /**
     * Refresh access JWT token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh(Request $request)
    {
        if ($token = $this->guard()->refresh()) {
            return $this->userHasAuthenticate($token);
        }
        return $this->userFailedAuthenticate();
    }

    /**
     * Get guard provider.
     *
     * @return mixed
     */
    private function guard()
    {
        return Auth::guard();
    }

    public function userHasAuthenticate($token)
    {
        return response()
            ->json(['status' => 'success'], 200)
            ->header('Authorization', $token);
    }

    public function userFailedAuthenticate()
    {
        return response()
            ->json(['error' => 'auth_error'], 401);
    }
}
