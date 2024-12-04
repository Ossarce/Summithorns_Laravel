<?php

namespace App\Http\Controllers;

use App\DataTables\BouldersDataTable;
use App\DataTables\ClimbingRoutesDataTable;
use App\DataTables\ZoneDataTable;
use App\DataTables\ZonesTableDataTable;
use App\Jobs\SendMail;
use App\Mail\ContactMailable;
use App\Models\Entry;
use App\Models\Favorite;
use App\Models\Spot;
use App\Models\User;
use App\Models\Zone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class PublicPageController extends Controller
{
    public function home() {
        $spots = Spot::take(3)->latest()->get();
        foreach($spots as $spot) {
            $spot->short_description = Str::limit($spot->description, 150, '...');
        }

        $userId = Auth::id();
        $userFavorites = [];
        if($userId !== null) {
            $user = User::with('favorites')->find($userId);
            $userFavorites = $user->favorites->pluck('spot_id')->toArray();
        }

        $entries = Entry::with(['user', 'entryCategory'])->latest()->take(2)->get();
        foreach($entries as $entry) {
            $entry->short_description = Str::limit($entry->description, 150, '...');
        }

        return view('public.home', compact('spots', 'entries', 'userFavorites'));
    }

    public function spots() {
        $spots = Spot::with(['zones', 'climbingType'])->latest()->paginate(6);

        $userId = Auth::id();
        $userFavorites = [];
        if($userId !== null) {
            $user = User::with('favorites')->find($userId);
            $userFavorites = $user->favorites->pluck('spot_id')->toArray();
        }

        foreach($spots as $spot) {
            $spot->short_description = Str::limit($spot->description, 150, '...');
        }

        return view('public.spots', compact('spots', 'userFavorites'));
    }

    public function spot(string $id) {
        $spot = Spot::with('zones', 'climbingType')->findOrFail($id);
        $zones = Zone::find($spot->id);

        $totalRoutes = $spot->zones->sum(fn($zone) => $zone->climbingRoutes()->count());
        $totalBoulders = $spot->zones->sum(fn($zone) => $zone->boulders()->count());

        $userId = Auth::id();
        $isFavorite = $userId ? Favorite::where('user_id', $userId)->where('spot_id', $spot->id)->exists() : false;

        $dataTable = new ZoneDataTable($spot->id);

        return $dataTable->render('public.spot', compact('spot', 'isFavorite', 'zones', 'totalRoutes', 'totalBoulders'));
        // return view('public.spot', compact('spot', 'isFavorite', 'zones'));
    }

    public function zone(Spot $spot, Zone $zone) {
        if($spot->climbingType->name === 'Deportiva') {
            $dataTable = new ClimbingRoutesDataTable($zone->id);
            return $dataTable->render('public.zone', compact('spot', 'zone'));
        }

        if($spot->climbingType->name === 'Boulder') {
            $dataTable = new  BouldersDataTable($zone->id);
            return $dataTable->render('public.zone', compact('spot', 'zone'));
        }
    }

    public function blog() {
        $entries = Entry::with(['user', 'entryCategory'])->latest()->paginate(2);
        // $entries = Entry::latest()->get();
        foreach($entries as $entry) {
            $entry->short_description = Str::limit($entry->description, 150, '...');
        }

        return view('public.blog', compact('entries'));
    }

    public function entry(string $id) {
        $entry = Entry::findOrFail($id);

        return view('public.entry', compact('entry'));
    }

    public function contact() {

        return view('public.contact');
    }

    public function submit(Request $request) {
        $request->validate([
            'contact.name' => 'required|string',
            'contact.email' => 'required|email',
            'contact.purpose' => 'required|string',
            'contact.message' => 'required|string'
        ]);

        $contactData = $request->input('contact');
        $mailable = new ContactMailable($contactData);
        $recipient = 'noresponder@summithorns.helioho.st';

        SendMail::dispatch($mailable, $recipient);

        notyf('Nos pondremos en contacto a la brevedad!');

        return redirect()->route('public.contact');
    }

    public function us() {
        return view('public.us');
    }
}
