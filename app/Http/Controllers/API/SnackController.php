<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Snack;
use App\Helpers\ResponseFormatter;

class SnackController extends Controller
{
    public function index()
    {
        $snacks = Snack::all();

        return ResponseFormatter::success(['snacks' => $snacks], 'Data berhasil ditampilkan!');
    }
}
