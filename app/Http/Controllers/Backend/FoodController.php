<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
}
