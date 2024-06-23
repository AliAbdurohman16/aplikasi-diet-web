<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
        $age = $request->age;
        $gender = $request->gender;
        $weight = $request->weight;
        $height = $request->height;
        $daily = $request->daily;
        $activity = $request->activity;

        $activityWeekly ='';
        $result = '';


        switch ($activity){
            case 'office':
                $activityWeekly = 1.2;
                break;
            case 'light' :
                $activityWeekly = 1.375;
                    break;
            case 'moderate':
                $activityWeekly = 1.55;
                break;
            case 'heavy':
                $activityWeekly = 1.725;
                break;
            case 'veryheavy':
                $activityWeekly = 1.9;
                break;
            default:
                $activityWeekly = 1.2;
        }





        if ($gender == 'Laki-laki') {
            $result = ($height * 6.25) + ($weight * 9.99) + 5 * $activityWeekly;
        } else {
$result = ($height * 6.25) + ($weight * 9.99) + 5 * $activityWeekly;
        }


        $data = [
            'result' => $result,
        ];

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
