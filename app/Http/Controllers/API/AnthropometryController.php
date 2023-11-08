<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;

class AnthropometryController extends Controller
{
    public function index(Request $request)
    {
        $weight = $request->weight; // Body weight in kilograms (kg)
        $height = $request->height; // Height in meters (m)

        // Squares height in meters
        $heightSquared = $height * $height;

        // Calculate BMI
        $imt = $weight / $heightSquared;

        $result = '';

        if ($imt < 18.5) {
            $result = 'Underweight';
        } else if ($imt >= 18.5 && $imt <= 24.9) {
            $result = 'Normal';
        } else if ($imt >= 25 && $imt <= 29.9) {
            $result = 'Overweight';
        } else if ($imt >= 30 && $imt <= 34.9) {
            $result = 'Obesity Class I';
        } else if ($imt >= 35 && $imt <= 39.9) {
            $result = 'Obesity Class II';
        } else if ($imt >= 40) {
            $result = 'Obesity Class III';
        }

        $data = [
            'imt' => $imt,
            'result' => $result,
        ];

        return ResponseFormatter::success($data, 'Kalkulasi IMT berhasil!');
    }
}
