<?php

namespace App\Http\Controllers;

use App\DataTables\AdminZonesDataTable;
use App\Models\Spot;
use App\Models\User;
use App\Models\Zone;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Exception;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

class ZoneController extends Controller
{
    public function index(Spot $spot) {
        $userId = Auth::id();
        $user = User::find($userId);
        $zones = $spot->zones;
        $dataTable = new AdminZonesDataTable($spot->id);

        return $dataTable->render('admin.spots.zones.index', compact('spot', 'zones', 'user'));
    }

    public function create(Spot $spot) {
        $userId = Auth::id();
        $user = User::find($userId);
        return view('admin.spots.zones.create', compact('spot', 'user'));
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
            Storage::disk('s3')->put('images/spots/zones/' . $imageName, (string) $img->encode());
        }else {
            return response()->json(['error' => 'Hubo un error al procesar la imagen!'], 400);
        };

        $zone = new Zone();
        $zone->spot_id = $spot->id;
        $zone->name = $request->input('zone.name');
        $zone->setImage($imageName);
        $zone->details = $request->input('zone.details');

        // dd($zone);

        if($zone->save()) {
            notyf()->ripple(false)->success('Zona añadida correctamente!');
        }

        return redirect()->route('zones.index' , compact('spot'));
    }

    public function edit(Spot $spot, Zone $zone) {
        $userId = Auth::id();
        $user = User::find($userId);
        return view('admin.spots.zones.edit', compact('spot', 'zone', 'user'));
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
            Storage::disk('s3')->put('images/spots/zones/' . $imageName, (string) $img->encode());

            $zone->setImage($imageName);
        }

        $zone->name = $request->input('zone.name');
        $zone->details = $request->input('zone.details');

        // dd($zone);

        if($zone->save()) {
            notyf()->ripple(false)->success('Zona editada correctamente!');
        }

        return redirect()->route('zones.index', compact('spot'));
    }

    public function destroy(Spot $spot, Zone $zone) {
        $zone->delete();

        if(request()->ajax()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Zona eliminada correctamente'
            ]);
        }

        return redirect()->route('zones.index', compact('spot'));
    }
}
