<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Drink;

class DrinkController extends Controller
{
    public function index()
    {
        $drinks = Drink::all();

        return response()->json($drinks, 200);
    }
}
