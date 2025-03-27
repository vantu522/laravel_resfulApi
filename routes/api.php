<?php

use App\Http\Controllers\Api\PatientController;
use App\Http\Controllers\EmployeeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('employees',[EmployeeController::class,'index']);
Route::post('employees',[EmployeeController::class,'store']);


Route::prefix('patients')->group(function(){
    Route::get('/',[PatientController::class,'index']);
    Route::get('/{id}',[PatientController::class,'show']);

    Route::post('/create',[PatientController::class,'store']);


});

