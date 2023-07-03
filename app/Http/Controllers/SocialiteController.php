<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function login()
    {

        return Socialite::driver('github')->redirect();
    }

    public function redirect()
    {

        $socialiteuser = Socialite::driver('github')->user();
        $user = User::updateOrCreate([
            'provider_id' => $socialiteuser->getId() //check the user exsist or no
        ], [
            'name' => $socialiteuser->getName(),
            'email' => $socialiteuser->getEmail(),
        ]);
        //
            Auth::login($user, true);
            //retturn dashboard
            return to_route('dashboard');
    }


    ///////////////////////////////////
    public function dribbble_login()
    {

        return Socialite::driver('dribbble')->redirect();
    }

    public function dribbble_redirect()
    {

        $socialiteuser = Socialite::driver('dribbble')->user();
        $user = User::updateOrCreate([
            'dribbble_id' => $socialiteuser->getId() //check the user exsist or no
        ], [
            'name' => $socialiteuser->getName(),
            'email' => $socialiteuser->getEmail(),
        ]);
        //
            Auth::login($user, true);
            //retturn dashboard
            return to_route('dashboard');
    }
}
