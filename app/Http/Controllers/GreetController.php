<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GreetController extends Controller
{
    public function greet(Request $request): JsonResponse
    {
        $request->validate([
            'visitor_name' => 'required|string'
        ]);
        $temp = 11;
//        $response = Http::get("http://ip-api.com/json/{$request->ip()}");
        $response = Http::withHeader('key', config('app.weather_api_key'))->get("https://api.weatherapi.com/v1/q={$request->ip()}");
//        if ($response->failed()) {
//            return response()->json(['error' => 'greeting failed'], 500);
//        }
        $body = $response->json();
//        $latitude = $body['lat'];
//        $longitude = $body['lon'];
//        $greeting = [
//            'client_ip' => $request->ip(),
////            $request->
//            'location' => $location,
//            'greeting' => "Hello, {$request->visitor_name}!, the temperature is {$temp} degrees Celcius in {$location}"
//        ];
        return response()->json(['data' => $body]);
    }
}
