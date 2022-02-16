<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/students',function (Request $request) {
    return response()->json(['data' => App\Models\Student::all()]);
});

//get all the classrooms.
Route::get('/classrooms',function (Request $request) {
    return response()->json(['data' => App\Models\Classroom::all()]);
});

// get students in single class by limit condetion
Route::get('/students/{classroom_id}/{offset?}/{limit?}',function ($class_id, $offset=0, $limit=10) {
    return response()->json(['data' => App\Models\Student::where('classroom_id', $class_id)->offset($offset)->limit($limit)->get()]);
});
