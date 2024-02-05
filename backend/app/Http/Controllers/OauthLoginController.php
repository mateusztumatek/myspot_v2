<?php

namespace App\Http\Controllers;

use App\Consts\FrontRoutes;
use App\Consts\OauthLoginProvider;
use App\Consts\UserSource;
use App\Helpers\RoutingHelper;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Socialite\Facades\Socialite;
use \Laravel\Socialite\Contracts\User as SocialiteUser;

class OauthLoginController extends Controller
{

    public function __construct(protected CreatesNewUsers $createsNewUsers)
    {
    }

    /**
     * @param Request $request
     * @param OauthLoginProvider $oauthLoginProvider
     * @return \Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function redirect(Request $request, OauthLoginProvider $oauthLoginProvider){
        return Socialite::driver($oauthLoginProvider->value)->redirect();
    }

    /**
     * @param Request $request
     * @param OauthLoginProvider $oauthLoginProvider
     * @param StateFulGuard $guard
     * @return \Illuminate\Http\RedirectResponse
     */
    public function callback(Request $request,
                             OauthLoginProvider $oauthLoginProvider,
                             StatefulGuard $guard
    ){
        $guard->login($this->getUserFromRequest(Socialite::driver($oauthLoginProvider->value)->user(), $oauthLoginProvider));
        return redirect()->to(RoutingHelper::getFrontUrl(FrontRoutes::DASHBOARD, [], true));
    }


    /**
     * @param SocialiteUser $socialiteUser
     * @return User
     */
    private function getUserFromRequest(SocialiteUser $socialiteUser, OauthLoginProvider $oauthLoginProvider) : User{
        if($user = User::whereEmail($socialiteUser->getEmail())->first()){
            return $user;
        }
        $source = match ($oauthLoginProvider->value) {
            'google' => UserSource::GOOGLE,
            'facebook' => UserSource::FACEBOOK,
            default => UserSource::DEFAULT
        };
        $password = Str::random(20);
        $user = $this->createsNewUsers->create(
            [
                'name' => $socialiteUser->getName(),
                'email' => $socialiteUser->getEmail(),
                'password' => $password,
                'password_confirmation' => $password,
                'avatar' => $socialiteUser->getAvatar(),
                'source' => $source->value
            ]
        );

        $user->markEmailAsVerified();
        event(new Registered($user));
        return $user;
    }
}
