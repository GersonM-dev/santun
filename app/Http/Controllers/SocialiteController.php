<?php

namespace App\Http\Controllers;
 
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;
 
class SocialiteController extends Controller
{
    public function redirect(string $provider)
    {
        $this->validateProvider($provider);
 
        return Socialite::driver($provider)->redirect();
    }
 
    public function callback(string $provider)
    {
        $this->validateProvider($provider);

        $response = Socialite::driver($provider)->user();

        $user = User::firstWhere(['email' => $response->getEmail()]);

        if ($user) {
            $user->update([$provider . '_id' => $response->getId()]);
        } else {
            $user = User::create([
                $provider . '_id' => $response->getId(),
                'name'            => $response->getName(),
                'email'           => $response->getEmail(),
                'password'        => '',
            ]);
        }

        auth()->login($user);

        // Check user role and redirect accordingly
        if (!in_array($user->role, ['super_admin', 'admin'])) {
            return redirect('/');
        }

        return redirect()->intended(route('filament.admin.pages.dashboard'));
    }
 
    protected function validateProvider(string $provider): array
    {
        return validator(
            ['provider' => $provider],
            ['provider' => 'in:google']
        )->validate();
    }
}