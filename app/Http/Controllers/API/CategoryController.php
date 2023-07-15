<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return response()->json($categories, 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255|unique:categories',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $category = Category::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title, '-'),
        ]);

        return response()->json($category, 201);
    }

    public function show($id)
    {
        $category = Category::find($id);

        return response()->json($category, 200);
    }

    public function edit($id)
    {
        $category = Category::find($id);

        return response()->json($category, 200);
    }

    public function update(Request $request, $id)
    {
        $category = Category::find($id);

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $category->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title, '-'),
        ]);

        return response()->json($category, 200);
    }

    public function destroy($id)
    {
        $category = Category::find($id);

        $category->delete();

        return response()->json(['message' => 'Category deleted successfully'], 200);
    }
}
