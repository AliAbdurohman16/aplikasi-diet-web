<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Food;
use App\Helpers\ResponseFormatter;

class FoodController extends Controller
{
    public function index()
    {
        $foods = Food::all();

        return ResponseFormatter::success(['foods' => $foods], 'Data berhasil ditampilkan!');
    }
}
