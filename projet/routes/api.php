<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\TournamentController;
use App\Http\Controllers\testController;
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
Route::get('/players', [PlayerController::class, 'index']);
Route::post('/register', [UserController::class, 'register']);
Route::post('/logout', [UserController::class, 'logout']);
Route::post('/login', [UserController::class, 'login']);
Route::get('/player', [PlayerController::class, 'player']);
Route::post('/playeradd', [PlayerController::class, 'playeradd']);
Route::get('/players/{id}', [PlayerController::class, 'show']);
Route::put('/players/{id}', [PlayerController::class, 'update']);
Route::delete('/player/delete/{id}', [PlayerController::class, 'playerDelete']);
Route::get('/tournament', [TournamentController::class, 'tournament']);
Route::post('/tournament/add', [TournamentController::class, 'addTournament'])->name('tournament.add');
Route::post('/tournament/update/{id}', [TournamentController::class, 'updateTournament'])->name('tournament.update');
Route::post('/tournament/delete/{id}', [TournamentController::class, 'deleteTournament'])->name('tournament.delete');
Route::delete('/players/{id}', [PlayerController::class, 'destroy']);