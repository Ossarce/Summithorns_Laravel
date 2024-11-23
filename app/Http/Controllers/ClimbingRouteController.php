<?php

namespace App\Http\Controllers;

use App\DataTables\AdminClimbingRoutesDataTable;
use App\Models\ClimbingRoute;
use App\Models\RouteGrade;
use App\Models\Spot;
use App\Models\User;
use App\Models\Zone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

class ClimbingRouteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Spot $spot, Zone $zone)
    {
        $userId = Auth::id();
        $user = User::find($userId);
        $climbingRoutes = $zone->climbingRoutes;
        $dataTable = new AdminClimbingRoutesDataTable($spot->id, $zone->id);

        return $dataTable->render('admin.spots.zones.climbing_routes.index', compact('spot', 'zone', 'climbingRoutes', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Spot $spot, Zone $zone)
    {
        $userId = Auth::id();
        $user = User::find($userId);
        $routeGrades = RouteGrade::all();

        return view('admin.spots.zones.climbing_routes.create', compact('spot', 'zone', 'routeGrades', 'user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Spot $spot, Zone $zone)
    {
        $request->validate([
            'route.name' => 'required|string',
            'route.grade' => 'required|exists:route_grades,id',
            'route.image' => 'nullable|mimes:png,jpg,jpeg|max:2048',
            'route.details' => 'nullable|string'
            // 'route.setter' El seteador/abridor se implementara en un futuro cercano.
        ]);

        $climbingRoute = new ClimbingRoute();

        if($request->hasFile('route.image')) {
            $image = $request->file('route.image');
            $imageName = md5(uniqid(rand(), true)) . '.jpg';

            $img = Image::read($image);
            $img->cover(800,600);
            Storage::disk('s3')->put('images/spots/zones/routes/' . $imageName, (string) $img->encode());

            $climbingRoute->setImage($imageName);
        }

        $climbingRoute->zone_id = $zone->id;
        $climbingRoute->name = $request->input('route.name');
        $climbingRoute->grade_id = $request->input('route.grade');
        $climbingRoute->details = $request->input('route.details');


        if($climbingRoute->save()) {
            notyf()->ripple(false)->success('Vía añadida con éxito!');
        }

        return redirect()->route('routes.index', compact('spot', 'zone'));
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
    public function edit(Spot $spot, Zone $zone, ClimbingRoute $climbingRoute)
    {
        $userId = Auth::id();
        $user = User::find($userId);
        $routeGrades = RouteGrade::all();

        return view('admin.spots.zones.climbing_routes.edit', compact('spot', 'zone', 'routeGrades', 'climbingRoute', 'user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Spot $spot, Zone $zone, ClimbingRoute $climbingRoute)
    {
        $request->validate([
            'route.name' => 'required|string',
            'route.grade' => 'required|exists:route_grades,id',
            'route.image' => 'nullable|mimes:png,jpg,jpeg|max:2048',
            'route.details' => 'nullable|string',
            // 'route.setter' El seteador/abridor se implementara en un futuro cercano.
        ]);

        if($request->hasFile('route.image')) {
            $image = $request->file('route.image');
            $imageName = md5(uniqid(rand(), true)) . '.jpg';

            $img = Image::read($image);
            $img->cover(800,600);
            Storage::disk('s3')->put('images/spots/zones/routes/' . $imageName, (string) $img->encode());

            $climbingRoute->setImage($imageName);
        }

        $climbingRoute->zone_id = $zone->id;
        $climbingRoute->name = $request->input('route.name');
        $climbingRoute->grade_id = $request->input('route.grade');
        $climbingRoute->details = $request->input('route.details');

        if($climbingRoute->save()) {
            notyf()->ripple(false)->success('Vía editada con éxito!');
        }

        return redirect()->route('routes.index', compact('spot', 'zone'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Spot $spot, Zone $zone, ClimbingRoute $climbingRoute)
    {
        $climbingRoute->delete();

        if (request()->ajax()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Vía eliminada correctamente'
            ]);
        }

        return redirect()->route('routes.index', compact('spot', 'zone'));
    }
}
