<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\FormsController;
use App\Http\Controllers\Api\BranchesController;
use App\Http\Controllers\Api\SurveyResponsesController;

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

Route::apiResource("forms",FormsController::class,["as"=>"api"]);
Route::get("/formsreport/{id}",[FormsController::class,"report"]);
Route::apiResource("surveyresponses",SurveyResponsesController::class,["as"=>"api"]);
Route::get("/surveyresponsesdashboard/{form_id}",[SurveyResponsesController::class,"dashboard"]);
Route::get("/branchesdashboard",[BranchesController::class,"dashboard"]);

Route::get("/branches",[BranchesController::class,"index"]);


