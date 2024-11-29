<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

class ProfileController extends Controller
{

    public function index(string $id) {
        $user = User::with('profile', 'favorites', 'spots')->findOrFail($id);

        return view('profile.index', compact('user'));
    }

    /**
     * Display the user's profile form.
     */
    public function edit(string $id) {
        $user = User::with('profile')->findOrFail($id);

        $profile = $user->profile;

        return view('profile.edit', compact('user', 'profile'));
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'profile.first_name' => 'required|string|max:200',
            'profile,last_name' => 'nullable|string|max:200',
            'profile.avatar' => 'nullable|image|mimes:png,jpg, jpeg|max:2048',
            'profile.location' => 'nullable|string|max:255',
            'profile.bio' => 'nullable|string|max:300',
            'profile.website' => 'nullable|url|max:200',
            'profile.instagram' => 'nullable|url|max:300',
            'profile.facebook' => 'nullable|url|max:300',
        ]);

        $user = User::with('profile')->findOrFail($id);

        $profile = $user->profile;

        if($request->hasFile('profile.avatar')) {
            if($profile->avatar) {
                Storage::disk('s3')->delete('images/profiles/avatars/' . $profile->avatar);
            }

            $image = $request->file('profile.avatar');
            $imageName = md5(uniqid(rand(), true)) . '.jpg';

            $img = Image::read($image);
            $img->cover(800,600);
            Storage::disk('s3')->put('images/profiles/avatars/' . $imageName, (string) $img->encode());

            $profile->avatar = $imageName;
        }

        $profile->first_name = $request->input('profile.first_name');
        $profile->last_name = $request->input('profile.last_name');
        $profile->is_private = $request->has('profile.private') ? 1 : 0;
        $profile->location = $request->input('profile.location');
        $profile->website = $request->input('profile.website');
        $profile->instagram = $request->input('profile.instagram');
        $profile->facebook = $request->input('profile.facebook');

        // dd($request->all(), $profile);

        $profile->save();

        notyf()->ripple(false)->success('Perfil editado con exito!');
        return redirect()->route('profile.index', $profile);
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
