<?php

namespace App;

use App\Http\Controllers\Api\Auth\LoginUserListener;
use App\Http\Repositories\UserRepository;;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Contracts\Factory as Socialite;

class AuthenticateUser {
    /**
     * @var Auth
     */
    private $auth;
    /**
     * @var Socialite
     */
    private $socialite;
    /**
     * @var UserRepository
     */
    private $users;

    /**
     * AuthenticateUser constructor.
     * @param Auth $auth
     * @param Socialite $socialite
     * @param UserRepository $users
     */
    public function __construct(Auth $auth, Socialite $socialite, UserRepository $users)
    {
        $this->auth = $auth;
        $this->socialite = $socialite;
        $this->users = $users;
    }

    public function execute($hasCode, $socialNetwork, LoginUserListener $listener)
    {
        if (!$hasCode) {
            return $this->getAuthorizationFirst($socialNetwork);
        }
        $user = $this->users->findByEmailOrCreate($this->getSocialNetworkUser($socialNetwork));
        $token = $this->auth::guard()->login($user);

        return $listener->userHasAuthenticate($token);
    }

    public function getAuthorizationFirst($socialNetwork)
    {
        return $this->socialite->driver($socialNetwork)
            ->stateless()
            ->redirect();
    }

    private function getSocialNetworkUser($socialNetwork)
    {
        return $this->socialite->driver($socialNetwork)
            ->stateless()
            ->user();
    }
}
