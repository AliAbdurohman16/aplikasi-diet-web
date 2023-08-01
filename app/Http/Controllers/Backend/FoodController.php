<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Food;
use App\Models\Subcategory;

class FoodController extends Controller
{
    public function index()
    {
        // get data
        $data['foods'] = Food::all();

        return view('backend.foods.index', $data);
    }

    public function create()
    {
        // get data
        $data['subcategories'] = Subcategory::all();

        return view('backend.foods.add', $data);
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
            $imagePath = $request->file('image')->store('public/foods');
            $imageName = basename($imagePath);
        } else {
            $imageName = '';
        }

        // insert to table
        Food::create([
            'image' => $imageName,
            'name' => $request->name,
            'subcategory_id' => $request->subcategory,
            'calories' => $request->calories,
            'proteins' => $request->proteins,
            'carbohydrate' => $request->carbohydrate,
            'fat' => $request->fat,
            'description' => $request->description,
        ]);

        return redirect('foods')->with('message', 'Makanan berhasil ditambahkan!');
    }

    public function edit($id)
    {
        // get data
        $data = [
            'food' => Food::find($id),
            'subcategories' => Subcategory::all(),
        ];

        return view('backend.foods.edit', $data);
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
        $food = Food::find($id);

        // proces upload image
        if ($request->hasFile('image')) {
            if ($food->image && Storage::exists('public/foods/' . $food->image)) {
                Storage::delete('public/foods/' . $food->image);
            }

            $imagePath = $request->file('image')->store('public/foods');
            $imageName = basename($imagePath);
        } else {
            $imageName = $food->image;
        }

        // update to table
        $food->update([
            'image' => $imageName,
            'name' => $request->name,
            'subcategory_id' => $request->subcategory,
            'calories' => $request->calories,
            'proteins' => $request->proteins,
            'carbohydrate' => $request->carbohydrate,
            'fat' => $request->fat,
            'description' => $request->description,
        ]);

        return redirect('foods')->with('message', 'Makanan berhasil diubah!');
    }

    public function destroy($id)
    {
        // get data by id
        $food = Food::find($id);

        // proses delete image
        if ($food->image) {
            Storage::delete('public/foods/' . $food->image);
        }

        // delete data
        $food->delete();

        return response()->json(['message' => 'Makanan berhasil dihapus!']);
    }
}
