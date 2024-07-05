<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\TournamentController;

Route::get('/', function () {
    return view('home');
});

Route::post('/register', [UserController::class, 'register']);
Route::post('/logout', [UserController::class, 'logout']);
Route::post('/login', [UserController::class, 'login']);
Route::get('/player', [PlayerController::class, 'player'])->name('player');
Route::post('/player/add', [PlayerController::class, 'playeradd'])->name('playeradd');
Route::post('/player/update/{id}', [PlayerController::class, 'playerUpdate'])->name('player.update');
Route::post('/player/delete/{id}', [PlayerController::class, 'playerDelete'])->name('player.delete');
Route::get('/tournament', [TournamentController::class, 'tournament']);
Route::post('/tournament/add', [TournamentController::class, 'addTournament'])->name('tournament.add');
Route::post('/tournament/update/{id}', [TournamentController::class, 'updateTournament'])->name('tournament.update');
Route::post('/tournament/delete/{id}', [TournamentController::class, 'deleteTournament'])->name('tournament.delete');
