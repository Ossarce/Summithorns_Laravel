<?php

namespace App\Http\Controllers;

use App\Models\RouteGrade;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RouteGradeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $routeGrades = RouteGrade::all();

        return view('admin.admin_only.route_grades.index', compact('routeGrades'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.admin_only.route_grades.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'route_grade.grade' => 'required|string|unique:route_grades,route_grade'
        ]);

        $routeGrade = new RouteGrade();
        $routeGrade->route_grade = $request->input('route_grade.grade');

        $routeGrade->save();

        return redirect()->route('route-grades.index');
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
    public function edit(string $id)
    {
        $routeGrade = RouteGrade::find($id);
        if($routeGrade == NULL) {
            return redirect()->route('boulder-grades.index');
        }

        return view('admin.admin_only.route_grades.edit', compact('routeGrade'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'route_grade.grade' => [
                'required',
                'string',
                Rule::unique('route_grades', 'route_grade')->ignore($id)
            ]
        ]);

        $routeGrade = RouteGrade::findOrFail($id);

        $routeGrade->route_grade = $request->input('route_grade.grade');

        $routeGrade->save();

        return redirect()->route('route-grades.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $routeGrade = RouteGrade::findOrFail($id);

        $routeGrade->delete();

        return redirect()->route('route-grades.index');
    }
}
