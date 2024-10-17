<?php

namespace App\Http\Controllers;

use App\Models\BoulderGrade;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BoulderGradeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $boulderGrades = BoulderGrade::all();

        return view('admin.admin_only.boulder_grades.index', compact('boulderGrades'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.admin_only.boulder_grades.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'boulder_grade.grade' => 'required|string|unique:boulder_grades,boulder_grade'
        ]);

        $boulderGrade = new BoulderGrade();
        $boulderGrade->boulder_grade = $request->input('boulder_grade.grade');

        $boulderGrade->save();

        return redirect()->route('boulder-grades.index');
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
        $boulderGrade = BoulderGrade::find($id);
        if($boulderGrade == NULL) {
            return redirect()->route('boulder-grades.index');
        }

        return view('admin.admin_only.boulder_grades.edit', compact('boulderGrade'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'boulder_grade.grade' => [
                'required',
                'string',
                Rule::unique('boulder_grades', 'boulder_grade')->ignore($id)
            ]
        ]);

        $boulderGrade = BoulderGrade::findOrFail($id);

        $boulderGrade->boulder_grade = $request->input('boulder_grade.grade');

        $boulderGrade->save();

        return redirect()->route('boulder-grades.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $boulderGrade = BoulderGrade::findOrFail($id);

        $boulderGrade->delete();

        return redirect()->route('boulder-grades.index');
    }
}
