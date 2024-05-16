<?php

use App\Http\Controllers\V1\PatientController;
use App\Http\Controllers\V1\SmsController;
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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});


Route::prefix('v1')->group(function () {
    Route::apiResource('/patients', PatientController::class);
    Route::post('/send-sms/{idpatient}', [SmsController::class, 'sendSms']);
});
