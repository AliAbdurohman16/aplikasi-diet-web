<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sport;
use App\Helpers\ResponseFormatter;
use App\Models\History;
use Illuminate\Support\Facades\Auth;

class SportController extends Controller
{
    public function index()
    {
        $sports = Sport::all();

        return ResponseFormatter::success(['sports' => $sports], 'Data berhasil ditampilkan!');
    }


    public function store(Request $request)
    {
        $sport = History::create([
            'user_id' => Auth::user()->id,
            'name' => $request->name,
            'duration' => $request->duration,
            'calories' => $request->calories,
            'category' => $request->category,
            'protein' => '0',
            'fat' => '0',
            'carbohydrates' => '0',

        ]);

        return ResponseFormatter::success($sport, 'Data berhasil ditambahkan!');
    }
}
