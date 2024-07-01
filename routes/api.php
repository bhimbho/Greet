<?php

use App\Http\Controllers\GreetController;
use Illuminate\Support\Facades\Route;


Route::get('/hello', [GreetController::class, 'greet']);

