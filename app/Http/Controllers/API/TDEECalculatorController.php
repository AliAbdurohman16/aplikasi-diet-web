<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\BMRCalculator;
use App\Models\TDEECalculator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TDEECalculatorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     *
     */
    public function index(Request $request)
    {

        $activity = $request->activity;
        $bmr = BMRCalculator::where('user_id', Auth::user()->id)->latest()->first();

        $activityWeekly ='';
        $result = '';


        switch ($activity){
            case 'Minimal':
                $activityWeekly = 1.2;
                break;
            case 'Ringan':
                $activityWeekly = 1.375;
                    break;
            case 'Sedang':
                $activityWeekly = 1.55;
                break;
            case 'Berat':
                $activityWeekly = 1.725;
                break;
            case 'Ekstra Berat':
                $activityWeekly = 1.9;
                break;
            default:
                $activityWeekly = 1.2;
        }




        $result = $bmr->result * $activityWeekly;


        $data = [
            'result' => $result,
            'user_id' => Auth::user()->id,
        ];

        TDEECalculator::create($data);

        return ResponseFormatter::success($data, 'Kalkulasi TDEE Calculator Success');
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
