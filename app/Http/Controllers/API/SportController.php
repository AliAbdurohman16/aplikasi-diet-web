<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sport;

class SportController extends Controller
{
    public function index()
    {
        $sports = Sport::all();

        return response()->json($sports, 200);
    }
}
