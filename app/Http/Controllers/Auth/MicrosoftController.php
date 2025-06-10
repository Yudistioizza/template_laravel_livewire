<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class MicrosoftController
{
    public function redirectToMicrosoft()
    {
        return Socialite::driver('microsoft')->redirect();
    }

    public function handleMicrosoftCallback()
    {
        $microsoftUser = Socialite::driver('microsoft')->user();

        // Cari user berdasarkan email
        $user = User::where('email', $microsoftUser->getEmail())->first();

        if (!$user) {
            // Jika user belum ada, buat user baru
            $user = User::create([
                'name' => $microsoftUser->getName(),
                'email' => $microsoftUser->getEmail(),
                // Bisa generate password random, karena login pakai SSO
                'password' => bcrypt(str()->random(16)),
            ]);
        }

        Auth::login($user, true);

        return redirect()->intended('/dashboard');
    }
}