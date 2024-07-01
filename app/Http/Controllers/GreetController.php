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
        $location = Http::get("http://ip-api.com/json/{$request->ip()}");
        $greeting = [
            'client_ip' => $request->ip(),
            'location' => $location,
            'greeting' => "Hello, {$request->visitor_name}!, the temperature is {$temp} degrees Celcius in {$location}"
        ];
        return response()->json($greeting);
    }
}
