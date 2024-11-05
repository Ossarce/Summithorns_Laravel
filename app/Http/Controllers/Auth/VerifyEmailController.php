<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        $user = $request->user();

        if ($user->hasVerifiedEmail()) {
            notyf()->ripple(false)->info('Tu cuenta ya ha sido verificada');
            return redirect()->intended(route('public.home').'?verified=1');
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));

            // Actualizar la columna `is_verified` a 1
            $user->is_verified = true;
            $user->save();
            notyf()->ripple(false)->success('Cuenta verificada con exito!');
        }

        return redirect()->intended(route('public.home').'?verified=1');
    }
}
