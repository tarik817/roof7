<?php

namespace App\Http\Controllers;


use App\AuthenticateUser;
use App\Http\Controllers\Api\Auth\LoginUserListener;
use Illuminate\Http\Request;

class SocialAuthController extends Controller  implements LoginUserListener
{

    private $allowedSocialNetworks = ['github', 'facebook'];

    /**
     * Login user with social.
     *
     * @param $socialNetwork
     * @param AuthenticateUser $authenticateUser
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login($socialNetwork, AuthenticateUser $authenticateUser, Request $request)
    {
        if (!in_array($socialNetwork, $this->allowedSocialNetworks)) {
            return response()
                ->json(['error' => 'auth_error'], 401);
        }
        return $authenticateUser->execute($request->has('code'), $socialNetwork, $this);
    }

    /**
     * Listener for AuthenticateUser class.
     *
     * @param $token
     * @param bool $needRedirect
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function userHasAuthenticate($token, $needRedirect = false)
    {
        return redirect('/user/login?loginToken=' . $token)
            ->header('Authorization', $token);
    }
}
