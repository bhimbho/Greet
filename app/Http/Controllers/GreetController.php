<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;

class GreetController extends Controller
{
    public function greet(Request $request): JsonResponse
    {
        $request->validate([
            'visitor_name' => 'required|string'
        ]);

        $response = Http::withHeader('key', config('app.weather_api_key'))->get("https://api.weatherapi.com/v1/current.json?q={$request->ip()}");

        if ($response->failed()) {
            return response()->json(['error' => 'unable to generate greeting now'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        $body = $response->json();
        $location = $body['location']['name'];
        $greeting = [
            'client_ip' => $request->ip(),
            'location' => $location,
            'greeting' => "Hello, {$request->visitor_name}!, the temperature is {$body['current']['temp_c']} degrees Celcius in {$location}"
        ];

        return response()->json([$greeting]);
    }
}
