<?php

namespace App\Http\Controllers;

use App\DataTables\AdminEntriesDataTable;
use App\Models\Entry;
use App\Models\EntryCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

class EntryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = Auth::id();
        $user = User::find($userId);
        $entries = Entry::all();
        $dataTable = new AdminEntriesDataTable();

        return $dataTable->render('admin.entries.index', compact('entries', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $userId = Auth::id();
        $user = User::find($userId);
        $categories = EntryCategory::all();
        return view('admin.entries.create', compact('categories', 'user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
                'entry.title' => 'required|string',
                'entry.category_id' => 'required|integer',
                'entry.image' => 'required|image|mimes:png,jpg,jpeg|max:2048',
                'entry.description' => 'required|string|min:50'
        ]);

        if($request->hasFile('entry.image')) {
            $image = $request->file('entry.image');
            $imageName = md5(uniqid(rand(), true)) . '.jpg';

            $img = Image::read($image);
            $img->cover(800,600);
            Storage::disk('s3')->put('images/blog/' . $imageName, (string) $img->encode());
        }else {
            return response()->json(['error' => 'Hubo un error al procesar las imagen!']);
        };

        $entry = new Entry();
        $entry->user_id = Auth::id();
        $entry->title = $request->input('entry.title');
        $entry->category_id = $request->input('entry.category_id');
        $entry->setImage($imageName);
        $entry->description = $request->input('entry.description');


        if($entry->save()) {
            notyf()->ripple(false)->success('Entrada creada con éxito!');
        }

        return redirect()->route('entries.index');
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
        $userId = Auth::id();
        $user = User::find($userId);
        $categories = EntryCategory::all();
        $entry = Entry::find($id);

        if($entry === NULL) {
            return redirect()->route('entries.index');
        }

        return view('admin.entries.edit', compact('categories','entry', 'user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'entry.title' => 'required|string',
            'entry.category_id' => 'required|integer',
            'entry.image' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'entry.description' => 'required|string|min:50'
        ]);

        $entry = Entry::findOrFail($id);

        if($request->file('entry.image')) {
            $entry->deleteImage();

            $image = $request->file('entry.image');
            $imageName = md5(uniqid(rand(), true)) . '.jpg';

            $img = Image::read($image);
            $img->cover(800,600);
            Storage::disk('s3')->put('images/blog/' . $imageName, (string) $img->encode());

            $entry->setImage($imageName);
        };

        $entry->title = $request->input('entry.title');
        $entry->category_id = $request->input('entry.category_id');
        $entry->description = $request->input('entry.description');

        if($entry->save()) {
            notyf()->ripple(false)->success('Entrada editada correctamente!');
        }

        return redirect()->route('entries.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $entry = Entry::findOrFail($id);

        $entry->delete();

        if (request()->ajax()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Entrada eliminada correctamente'
            ]);
        }

        return redirect()->route('entries.index');
    }
}
