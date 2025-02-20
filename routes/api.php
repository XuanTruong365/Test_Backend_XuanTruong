<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\Test2Controller;
use App\Http\Controllers\Test3Controller;
use App\Http\Controllers\Test4Controller;
use App\Http\Controllers\Test5Controller;


Route::prefix('accounts')->group(function () {
    Route::get('/', [AccountController::class, 'index']);
    Route::get('/{id}', [AccountController::class, 'show']);
    Route::post('/', [AccountController::class, 'store']);
    Route::put('/{id}', [AccountController::class, 'update']);
    Route::delete('/{id}', [AccountController::class, 'destroy']);
});
Route::post('/showSerialpaso', [Test2Controller::class, 'getFile']);
Route::get('/student-statistics', [Test3Controller::class, 'countStudentsByAge']);
Route::get('/top-20-percent', [Test4Controller::class, 'findTop20Percent']);
Route::get('/top-20-percent', [Test5Controller::class, 'getFurthestPeople']);
