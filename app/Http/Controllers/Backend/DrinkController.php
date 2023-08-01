<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Drink;
use App\Models\Subcategory;

class DrinkController extends Controller
{
    public function index()
    {
        // get data
        $data['drinks'] = Drink::all();

        return view('backend.drinks.index', $data);
    }

    public function create()
    {
        // get data
        $data['subcategories'] = Subcategory::all();

        return view('backend.drinks.add', $data);
    }

    public function store(Request $request)
    {
        // validaton
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'name' => 'required|max:255',
            'subcategory' => 'required',
            'calories' => 'required',
            'proteins' => 'required',
            'carbohydrate' => 'required',
            'fat' => 'required',
            'description' => 'required',
        ]);

        // process upload image
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/drinks');
            $imageName = basename($imagePath);
        } else {
            $imageName = '';
        }

        // insert to table
        Drink::create([
            'image' => $imageName,
            'name' => $request->name,
            'subcategory_id' => $request->subcategory,
            'calories' => $request->calories,
            'proteins' => $request->proteins,
            'carbohydrate' => $request->carbohydrate,
            'fat' => $request->fat,
            'description' => $request->description,
        ]);

        return redirect('drinks')->with('message', 'Minuman berhasil ditambahkan!');
    }

    public function edit($id)
    {
        // get data
        $data = [
            'drink' => Drink::find($id),
            'subcategories' => Subcategory::all(),
        ];

        return view('backend.drinks.edit', $data);
    }

    public function update(Request $request,$id)
    {
        // validaton
        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg|max:2048',
            'name' => 'required|max:255',
            'subcategory' => 'required',
            'calories' => 'required',
            'proteins' => 'required',
            'carbohydrate' => 'required',
            'fat' => 'required',
            'description' => 'required',
        ]);

        // get data by id
        $drink = Drink::find($id);

        // proces upload image
        if ($request->hasFile('image')) {
            if ($drink->image && Storage::exists('public/drinks/' . $drink->image)) {
                Storage::delete('public/drinks/' . $drink->image);
            }

            $imagePath = $request->file('image')->store('public/drinks');
            $imageName = basename($imagePath);
        } else {
            $imageName = $drink->image;
        }

        // update to table
        $drink->update([
            'image' => $imageName,
            'name' => $request->name,
            'subcategory_id' => $request->subcategory,
            'calories' => $request->calories,
            'proteins' => $request->proteins,
            'carbohydrate' => $request->carbohydrate,
            'fat' => $request->fat,
            'description' => $request->description,
        ]);

        return redirect('drinks')->with('message', 'Minuman berhasil diubah!');
    }

    public function destroy($id)
    {
        // get data by id
        $drink = Drink::find($id);

        // proses delete image
        if ($drink->image) {
            Storage::delete('public/drinks/' . $drink->image);
        }

        // delete data
        $drink->delete();

        return response()->json(['message' => 'Minuman berhasil dihapus!']);
    }
}
