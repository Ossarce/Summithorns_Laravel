<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Jobs\SendMail;
use App\Mail\PasswordResetMail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        $user = Password::getUser(['email' => $request->email]);

        if ($user) {
            $token = Password::createToken($user);

            // Log the token to verify if it's created correctly
            // Log::info('Token generado para restablecimiento de contraseña: ' . $token);

            if (!$token) {
                // Log::error('Error: El token de restablecimiento de contraseña no se generó.');
                return back()->withErrors(['email' => 'Error generando el token de restablecimiento']);
            }

            // Crear el Mailable y enviar el Job
            $mailable = new PasswordResetMail($token);
            SendMail::dispatch($mailable, $request->email);

            notyf()->ripple(false)->success('Si la cuenta existe, recibirás un correo con instrucciones.');
        }

        return redirect()->route('login');
    }
}
