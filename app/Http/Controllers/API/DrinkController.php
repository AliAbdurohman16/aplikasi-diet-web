<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Drink;
use App\Helpers\ResponseFormatter;

class DrinkController extends Controller
{
    public function index()
    {
        $drinks = Drink::all();

        return ResponseFormatter::success(['drinks' => $drinks], 'Data berhasil ditampilkan!');
    }
}
