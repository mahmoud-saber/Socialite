<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function login($provider)
    {

        return Socialite::driver($provider)->redirect();
    }

    public function redirect($provider)
    {

        $socialiteuser = Socialite::driver($provider)->user();
        $user = User::updateOrCreate([
            'provider'=>$provider,
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



}