<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Snack;

class SnackController extends Controller
{
    public function index()
    {
        $snacks = Snack::all();

        return response()->json($snacks, 200);
    }
}
