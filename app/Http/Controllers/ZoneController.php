<?php

namespace App\Http\Controllers;

use App\Models\Spot;
use App\Models\Zone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

class ZoneController extends Controller
{
    public function index(Spot $spot) {
        $zones = $spot->zones;

        return view('admin.spots.zones.index', compact('spot', 'zones'));
    }

    public function create(Spot $spot) {

        return view('admin.spots.zones.create', compact('spot'));
    }

    public function store(Request $request, Spot $spot) {
        $request->validate([
            'zone.name' => 'required|string',
            'zone.image' => 'required|image|mimes:png,jpg,jpeg|max:2048',
            'zone.details' => 'nullable|string'
        ]);

        if($request->hasFile('zone.image')) {
            $image = $request->file('zone.image');
            $imageName = md5(uniqid(rand(), true)) . '.jpg';

            $img = Image::read($image);
            $img->cover(800, 600);
            Storage::disk('public')->put('images/spots/zones/' . $imageName, (string) $img->encode());
        }else {
            return response()->json(['error' => 'Hubo un error al procesar la imagen!'], 400);
        };

        $zone = new Zone();
        $zone->spot_id = $spot->id;
        $zone->name = $request->input('zone.name');
        $zone->setImage($imageName);
        $zone->details = $request->input('zone.details');

        // dd($zone);

        $zone->save();

        return redirect()->route('zones.index' , compact('spot'));
    }

    public function edit(Spot $spot, Zone $zone) {
        return view('admin.spots.zones.edit', compact('spot', 'zone'));
    }

    public function update(Request $request, Spot $spot, Zone $zone) {
        $request->validate([
            'zone.name' => 'required|string',
            'zone.image' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'zone.details' => 'nullable|string'
        ]);

        if($request->hasFile('zone.image')) {
            $zone->deleteImage();

            $image = $request->file('zone.image');
            $imageName = md5(uniqid(rand(), true)) . '.jpg';

            $img = Image::read($image);
            $img->cover(800,600);
            Storage::disk('public')->put('images/spots/zones/' . $imageName, (string) $img->encode());

            $zone->setImage($imageName);
        }

        $zone->name = $request->input('zone.name');
        $zone->details = $request->input('zone.details');

        // dd($zone);

        $zone->save();

        return redirect()->route('zones.index', compact('spot'));
    }

    public function destroy(Spot $spot, Zone $zone) {
        $zone->delete();

        return redirect()->route('zones.index', compact('spot'));
    }
}
