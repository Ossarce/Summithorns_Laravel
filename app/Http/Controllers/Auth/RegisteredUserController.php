<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Jobs\SendMail;
use App\Mail\VerifyEmail;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse {
    $request->validate([
        'username' => ['required', 'string', 'max:255', 'unique:users'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'confirmed', Rules\Password::defaults()],
    ]);

    DB::transaction(function () use ($request) {
        $user = User::create([
            'username' => $request->username,
            'email' => strtolower($request->email),
            'password' => Hash::make($request->password),
        ]);

        Profile::create([
            'id' => $user->id,
            'first_name' => $user->username,
        ]);

        SendMail::dispatch(new VerifyEmail($user), $user->email);
        event(new Registered($user));
        Auth::login($user);
    });

    return redirect()->route('verification.notice');
}
}
