<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Http;
class PostController extends Controller
{
    
    //
    public function Fetch_hourly_temperature(){
        $api_url = 'https://api.open-meteo.com/v1/forecast?latitude=23.777176&longitude=90.399452&current_weather=true&hourly=temperature_2m';
        $response = Http::get($api_url);

        $data = $response->json();
        $hourlyData = $data['hourly'];
        $times = $hourlyData['time'];
        $temperatures = $hourlyData['temperature_2m'];

        $bol = false;
        
        foreach ($times as $index => $time) {
         $temperature = $temperatures[$index];
         Post::updateOrCreate(
            ['date' => $time],
            [
                'date' => $time,
                'temperature' => $temperature
            ]
         );
         $bol = true;
        }
        $response = [];
        if($bol == true){
            $response['responseCode'] = 200;
            $response['responseMgs'] = 'Operation Successful';
        } else {
            $response['responseCode'] = 201;
            $response['responseMgs'] = 'Operation Not Successful';
        }
        return response()->json($response);
        //echo json_encode($response); 
        
        

    }  

}