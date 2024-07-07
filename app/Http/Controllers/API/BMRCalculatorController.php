<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\BMRCalculator;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BMRCalculatorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $gender = Auth::user()->gender;
        $age = Carbon::parse(Auth::user()->date_of_birth)->age;
        $height = $request->height;
        $weight = $request->weight;


        $result = '';


        if ($gender == 'Laki-laki') {
            $result = (10 * $weight) + (6.25 * $height) - (5 * $age) + 5;

        } else {
            $result = (10 * $weight) + (6.25 * $height) - (5 * $age) - 161;
        }


        $data = [
            'weight' => $weight,
            'height' => $height,
            'result' => $result,
        ];
        BMRCalculator::create([
            'result' => $result,
            'user_id' => Auth::user()->id,
        ]);


        return ResponseFormatter::success($data, 'Data berhasil ditambahkan!');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
