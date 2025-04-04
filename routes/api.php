<?php

use App\Http\Controllers\Api\AppointmentController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DoctorController;
use App\Http\Controllers\Api\PatientController;
use App\Http\Controllers\EmployeeController;
use App\Models\Appointment;
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
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);


Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);

Route::get('employees',[EmployeeController::class,'index']);
Route::post('employees',[EmployeeController::class,'store']);


Route::prefix('patients')->group(function(){
    Route::get('/',[PatientController::class,'index']);
    Route::get('/{id}',[PatientController::class,'show']);
    Route::post('/create',[PatientController::class,'store']);
    Route::put('/update/{id}',[PatientController::class,'update']);
    Route::delete('/delete/{id}',[PatientController::class,'destroy']);

});

Route::prefix('doctors')->group(function(){
    Route::get('/',[DoctorController::class,'index']);
    Route::post('/create',[DoctorController::class,'store']);
    Route::get('/{id}',[DoctorController::class,'show']);
    Route::put('/update/{id}',[DoctorController::class,'update']);
    Route::delete('/delete/{id}',[DoctorController::class,'destroy']);
    
});

Route::prefix('appointments')->group(function(){
    Route::get('/',[AppointmentController::class,'index']);
    Route::post('/create',[AppointmentController::class,'store']);
    Route::put('/update/{id}',[AppointmentController::class,'update']);
    Route::delete('/{id}',[AppointmentController::class,'destroy']);
});
 