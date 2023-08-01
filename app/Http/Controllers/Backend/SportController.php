<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Sport;

class SportController extends Controller
{
    public function index()
    {
        // get data
        $data['sports'] = Sport::all();

        return view('backend.sports.index', $data);
    }

    public function create()
    {
        return view('backend.sports.add');
    }

    public function store(Request $request)
    {
        // validaton
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'name' => 'required|max:255',
            'set' => 'required',
            'time' => 'required',
            'per' => 'required',
            'calories' => 'required',
            'fat' => 'required',
            'description' => 'required',
        ]);

        // process upload image
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/sports');
            $imageName = basename($imagePath);
        } else {
            $imageName = '';
        }

        // insert to table
        Sport::create([
            'image' => $imageName,
            'name' => $request->name,
            'set' => $request->set,
            'time' => $request->time,
            'per' => $request->per,
            'calories' => $request->calories,
            'fat' => $request->fat,
            'description' => $request->description,
        ]);

        return redirect('sports')->with('message', 'Olahraga berhasil ditambahkan!');
    }

    public function edit($id)
    {
        // get data
        $data['sport'] = Sport::find($id);

        return view('backend.sports.edit', $data);
    }

    public function update(Request $request,$id)
    {
        // validaton
        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg|max:2048',
            'name' => 'required|max:255',
            'set' => 'required',
            'time' => 'required',
            'per' => 'required',
            'calories' => 'required',
            'fat' => 'required',
            'description' => 'required',
        ]);

        // get data by id
        $sport = Sport::find($id);

        // proces upload image
        if ($request->hasFile('image')) {
            if ($sport->image && Storage::exists('public/sports/' . $sport->image)) {
                Storage::delete('public/sports/' . $sport->image);
            }

            $imagePath = $request->file('image')->store('public/sports');
            $imageName = basename($imagePath);
        } else {
            $imageName = $sport->image;
        }

        // update to table
        $sport->update([
            'image' => $imageName,
            'name' => $request->name,
            'set' => $request->set,
            'time' => $request->time,
            'per' => $request->per,
            'calories' => $request->calories,
            'fat' => $request->fat,
            'description' => $request->description,
        ]);

        return redirect('sports')->with('message', 'Olahraga berhasil diubah!');
    }

    public function destroy($id)
    {
        // get data by id
        $sport = Sport::find($id);

        // proses delete image
        if ($sport->image) {
            Storage::delete('public/sports/' . $sport->image);
        }

        // delete data
        $sport->delete();

        return response()->json(['message' => 'Olahraga berhasil dihapus!']);
    }
}
