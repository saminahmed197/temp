<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;


class WeatherDataController extends Controller
{
    public function Fetch_temperature_by_date_time(Request $request)
    {
       
        $date = $request->input('date');
        $time = $request->input('time');
        
        $char = "T";
        $new = "$date$char$time";
        $data = Post::where('date', $new)->value('temperature');
      
        $response = [];
        if(isset($data)){
            $response['temperature']= $data;
            $response['responseCode'] = 200;
            $response['responseMgs'] = 'Operation Successful';
        } else {
            $response['temperature']= '';
            $response['responseCode'] = 201;
            $response['responseMgs'] = 'Operation Not Successful';
        }
        return response()->json($response);
    
    }
        
    
}
