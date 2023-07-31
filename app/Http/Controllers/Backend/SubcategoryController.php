<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Subcategory;
use App\Models\Category;

class SubcategoryController extends Controller
{
    public function index()
    {
        // get data
        $data = [
            'categories' => Category::all(),
            'subcategories' => Subcategory::all(),
        ];


        return view('backend.subcategories.index', $data);
    }

    public function store(Request $request)
    {
        // validation
        $request->validate([
            'category' => 'required',
            'name' => 'required|max:255',
        ]);

        // insert to table categories
        Subcategory::create([
            'category_id' => $request->category,
            'name' => $request->name,
            'slug'  => Str::slug($request->name, '-')
        ]);

        return redirect()->back()->with('message', 'Subkategori berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        // validation
        $request->validate([
            'category' => 'required',
            'name' => 'required|max:255',
        ]);

        // get data find or fail by id
        $subcategory = Subcategory::findOrFail($id);

        // update to table categories
        $subcategory->update([
            'category_id' => $request->category,
            'name' => $request->name,
            'slug'  => Str::slug($request->name, '-')
        ]);

        return redirect()->back()->with('message', 'Subkategori berhasil diubah!');
    }

    public function destroy($id)
    {
        // get data find or fail by id
        $subcategory = Subcategory::findOrFail($id);

        // delete data
        $subcategory->delete();

        return response()->json(['message' => 'Subkategori berhasil dihapus!']);
    }
}
