<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LogoutController;

use App\Http\Controllers\HouseController;

use App\Http\Controllers\AluguelController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HouseController::class, 'index']);

Route::get('/house/create', function(){
    return view('create_house');
});
Route::post('/house/create', [HouseController::class, 'store']);

Route::get('/myhouses', [HouseController::class, 'myhouses']);

Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

Route::get('/house/{id}', [HouseController::class, 'show']);

Route::get('/alugar/{id}', [AluguelController::class, 'alugar']);

Route::get('/houses/alugadas', [AluguelController::class, 'alugadas']);

Route::get('/liberar/aluguel/{id}', [AluguelController::class, 'liberar_aluguel']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return redirect('/');
    })->name('dashboard');
});
