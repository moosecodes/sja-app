<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Models\User;

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

Route::put('/credits/{client_id}/add', function(string $client_id) {
  $user = User::find($client_id);
  $user->credits = $user->credits + 1;
  $user->save();
  return $user->credits;
});
Route::put('/credits/{client_id}/remove', function(string $client_id) {
  $user = User::find($client_id);
  $user->credits = $user->credits - 1;
  $user->save();
  return $user->credits;
});
