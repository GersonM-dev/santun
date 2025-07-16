<?php

namespace App\Http\Responses;
 
use App\Filament\Resources\OrderResource;
use Illuminate\Http\RedirectResponse;
use Livewire\Features\SupportRedirects\Redirector;
 
class LoginResponse extends \Filament\Http\Responses\Auth\LoginResponse
{
    public function toResponse($request): RedirectResponse|Redirector
    {
        if (!auth()->user()->hasRole(['super_admin', 'admin'])) {
            return redirect()->to('/');
        }
        return redirect()->to('/admin');
    }
}