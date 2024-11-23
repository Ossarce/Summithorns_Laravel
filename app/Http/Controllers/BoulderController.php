<?php

namespace App\Http\Controllers;

use App\DataTables\AdminBouldersDataTable;
use App\Models\Boulder;
use App\Models\BoulderGrade;
use App\Models\Spot;
use App\Models\User;
use App\Models\Zone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

class BoulderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Spot $spot, Zone $zone)
    {
        $userId = Auth::id();
        $user = User::find($userId);
        $boulders = $zone->boulders;
        $dataTable = new AdminBouldersDataTable($spot->id, $zone->id);

        return $dataTable->render('admin.spots.zones.boulders.index', compact('spot','zone', 'boulders', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Spot $spot, Zone $zone)
    {
        $userId = Auth::id();
        $user = User::find($userId);
        $boulderGrades = BoulderGrade::all();

        return view('admin.spots.zones.boulders.create', compact('spot', 'zone', 'boulderGrades', 'user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Spot $spot, Zone $zone)
    {
        $request->validate([
            'boulder.name' => 'required|string',
            'boulder.grade' => 'required|exists:boulder_grades,id',
            'boulder.image' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'boulder.details' => 'nullable|string',
            // 'boulder.setter' El seteador/abridor se implementara en un futuro cercano.
        ]);

        $boulder = new Boulder();

        if($request->hasFile('boulder.image')) {
            $image = $request->file('boulder.image');
            $imageName = md5(uniqid(rand(), true)) . '.jpg';

            $img = Image::read($image);
            $img->cover(800,600);
            Storage::disk('s3')->put('images/spots/zones/boulders/' . $imageName, (string) $img->encode());

            $boulder->setImage($imageName);
        }

        $boulder->zone_id = $zone->id;
        $boulder->name = $request->input('boulder.name');
        $boulder->grade_id = $request->input('boulder.grade');
        $boulder->details = $request->input('boulder.details');

        if($boulder->save()) {
            notyf()->ripple(false)->success('Boulder añadido con éxito!');
        }

        return redirect()->route('boulders.index', compact('spot', 'zone'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Spot $spot, Zone $zone, Boulder $boulder)
    {
        $userId = Auth::id();
        $user = User::find($userId);
        $boulderGrades = BoulderGrade::all();

        return view('admin.spots.zones.boulders.edit', compact('spot', 'zone', 'boulderGrades', 'boulder', 'user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Spot $spot, Zone $zone, Boulder $boulder)
    {
        $request->validate([
            'boulder.name' => 'required|string',
            'boulder.grade' => 'required|exists:boulder_grades,id',
            'boulder.image' => 'nullable|mimes:png,jpg,jpeg|max:2048',
            'boulder.details' => 'nullable|string',
            // 'boulder.setter' El seteador/abridor se implementara en un futuro cercano.
        ]);

        if($request->hasFile('boulder.image')) {
            $image = $request->file('boulder.image');
            $imageName = md5(uniqid(rand(), true)) . '.jpg';

            $img = Image::read($image);
            $img->cover(800,600);
            Storage::disk('s3')->put('images/spots/zones/boulders/' . $imageName, (string) $img->encode());

            $boulder->setImage($imageName);
        }

        $boulder->zone_id = $zone->id;
        $boulder->name = $request->input('boulder.name');
        $boulder->grade_id = $request->input('boulder.grade');
        $boulder->details = $request->input('boulder.details');

        if($boulder->save()) {
            notyf()->ripple(false)->success('Boulder editado con éxito!');
        }

        return redirect()->route('boulders.index', compact('spot', 'zone'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Spot $spot, Zone $zone, Boulder $boulder)
    {
        $boulder->delete();

        if(request()->ajax()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Boulder eliminado correctamente'
            ]);
        }

        return redirect()->route('boulders.index', compact('spot', 'zone'));
    }
}
