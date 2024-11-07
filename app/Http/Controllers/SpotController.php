<?php

namespace App\Http\Controllers;

use App\Models\ClimbingType;
use App\Models\Spot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;



class SpotController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tabHeader = 'Panel de Spots';
        $spots = Spot::all();


        return view('admin.spots.index', compact('spots', 'tabHeader'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tabHeader = 'Crear nuevo Spot';
        $climbingTypes = ClimbingType::all();

        return view('admin.spots.create', compact('tabHeader', 'climbingTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'spot.name' => 'required|string|unique:spots,name',
            'spot.image' => 'required|image|mimes:png,jpg,jpeg|max:2048',
            'spot.description' => 'required|string|min:50'
        ]);

        if($request->hasFile('spot.image')) {
            $image = $request->file('spot.image');
            $imageName = md5(uniqid(rand(), true)) . '.jpg';

            $img = Image::read($image);
            $img->cover(800,600);
            Storage::disk('s3')->put('images/spots/' . $imageName, (string) $img->encode());
        }else {
            return response()->json(['error' => 'Hubo un error al procesar la imagen!'], 400);
        };

        $spot = new Spot();
        $spot->user_id = Auth::id();
        $spot->name = $request->input('spot.name');
        $spot->climbing_type_id = $request->input('spot.climbing_type_id');
        $spot->setImage($imageName);
        $spot->bus = $request->has('spot.bus') ? 1 : 0;
        $spot->car = $request->has('spot.car') ? 1 : 0;
        $spot->bike = $request->has('spot.bike') ? 1 : 0;
        $spot->description = $request->input('spot.description');

        // dd($request->all(), $spot);
        $spot->save();

        return redirect()->route('spots.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $climbingTypes = ClimbingType::all();
        $spot = Spot::find($id);

        if($spot === null){
            return redirect()->route('spots.index');
        }

        return view('admin.spots.edit', compact('climbingTypes', 'spot'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'spot.name' => ['required', 'string', Rule::unique('spots', 'name')->ignore($id)],
            'spot.image' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'spot.description' => 'required|string|min:50'
        ]);

        $spot = Spot::findOrFail($id);

        if($request->hasFile('spot.image')) {
            $spot->deleteImage();

            $image = $request->file('spot.image');
            $imageName = md5(uniqid(rand(), true)) . '.jpg';

            $img = Image::read($image);
            $img->cover(800,600);
            Storage::disk('public')->put('images/spots/' . $imageName, (string) $img->encode());

            $spot->setImage($imageName);
        }

        $spot->name = $request->input('spot.name');
        $spot->climbing_type_id = $request->input('spot.climbing_type_id');
        $spot->bus = $request->has('spot.bus') ? 1 : 0;
        $spot->car = $request->has('spot.car') ? 1 : 0;
        $spot->bike = $request->has('spot.bike') ? 1 : 0;
        $spot->description = $request->input('spot.description');

        $spot->save();

        return redirect()->route('spots.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $spot = Spot::findOrFail($id);

        $spot->delete();

        return redirect()->route('spots.index');
    }
}
