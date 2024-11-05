<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Jobs\SendMail;
use App\Mail\VerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EmailVerificationNotificationController extends Controller
{
    /**
     * Send a new email verification notification.
     */
    public function store(Request $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            notyf()->ripple(false)->info('Tu cuenta ya ha sido verificada');
            return redirect()->intended(route('public.home'));
        }

        $user = $request->user();
        $mailable = new VerifyEmail($user);

        SendMail::dispatch($mailable, $user->email);
        notyf()->ripple(false)->info('Revisa tu bandeja de entrada y spam para el correo de verificación. Si no lo encuentras, intenta reenviarlo.');

        return back()->with('status', 'verification-link-sent');
    }
}
