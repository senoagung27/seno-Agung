<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\LogoutController;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\ChecklistController;
use App\Http\Controllers\Api\ChecklistItemController;

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
Route::post('/register', RegisterController::class)->name('register');
Route::post('/login', LoginController::class)->name('login');
// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();

// });
Route::get('/checklist',[ChecklistController::class, 'index']);
Route::post('/checklist',[ChecklistController::class, 'store']);
Route::delete('/checklist/{checklistId}',[ChecklistController::class, 'destroy']);

Route::get('/checklist/{checklistId}/item',[ChecklistItemController::class, 'index']);
Route::post('/checklist/{checklistId}/item',[ChecklistItemController::class, 'create']);
Route::get('/checklist/{checklistId}/item/{checklistItemId}',[ChecklistItemController::class, 'show']);
Route::put('/checklist/{checklistId}/item/{checklistItemId}',[ChecklistItemController::class, 'update']);
Route::delete('/checklist/{checklistId}/item/{checklistItemId}',[ChecklistItemController::class, 'destory']);
Route::put('/checklist/{checklistId}/item/rename/{checklistItemId}',[ChecklistItemController::class, 'renamelistItem']);

Route::post('/logout', LogoutController::class)->name('logout');
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
