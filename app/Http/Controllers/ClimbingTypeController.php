<?php

namespace App\Http\Controllers;

use App\Models\ClimbingType;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ClimbingTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $climbingTypes = ClimbingType::all();

        return view('admin.admin_only.climbing_types.index', compact('climbingTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.admin_only.climbing_types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'climbing_type.name' => 'required|string|unique:climbing_types,name'
        ]);

        $climbingType = new ClimbingType();
        $climbingType->name = $request->input('climbing_type.name');

        // dd($climbingType);
        $climbingType->save();

        return redirect()->route('climbing-types.index');
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
        $climbingType = ClimbingType::find($id);
        if($climbingType == NULL) {
            return redirect()->route('climbing-types.index');
        }

        return view('admin.admin_only.climbing_types.edit', compact('climbingType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'climbing_type.name' => [
                'required',
                'string',
                Rule::unique('climbing_types', 'name')->ignore($id)
            ]
        ]);

        $climbingType = ClimbingType::findOrFail($id);

        $climbingType->name = $request->input('climbing_type.name');

        $climbingType->save();

        return redirect()->route('climbing-types.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $climbingType = ClimbingType::finOrFail($id);

        $climbingType->delete();

        return redirect()->route('climbing-types.index');
    }
}
