<?php

use App\Http\Controllers\CharacterController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\VariantController;
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
//Rutas de Character
Route::get('/characters',[CharacterController::class, 'index']);
Route::post('/characters', [CharacterController::class, 'store']);
Route::get('/characters/{character}', [CharacterController::class, 'show']);
Route::post('/characters/addTags/{character}', [CharacterController::class, 'addTags']);
Route::post('/characters/removeTags/{character}', [CharacterController::class, 'deleteTags']);
Route::put('/characters/{character}', [CharacterController::class, 'update']);
Route::patch('/characters/{character}', [CharacterController::class, 'updatePartial']);
Route::delete('/characters/{character}', [CharacterController::class, 'destroy']);
Route::post('/characters/bulk', [CharacterController::class, 'bulkStore']);

//Rutas de tags
Route::get('/tags', [TagController::class, 'index']);
Route::post('/tags', [TagController::class, 'store']);
Route::put('/tags/{tag}', [TagController::class, 'update']);
Route::patch('/tags/{tag}', [TagController::class, 'updatePartial']);
Route::delete('/tags/{tag}', [TagController::class, 'destroy']);
Route::post('/tags/bulk',[TagController::class,'bulkStore']);

//Rutas de Variant
Route::get('/variants', [VariantController::class, 'index']);
Route::post('/variants', [VariantController::class, 'store']);
Route::get('/variants/{variant}', [VariantController::class, 'show']);
Route::put('/variants/{variant}', [VariantController::class, 'update']);
Route::patch('/variants/{variant}', [VariantController::class, 'updatePartial']);
Route::delete('/variants/{variant}', [VariantController::class, 'destroy']);
Route::post('/variants/bulk', [VariantController::class, 'bulkStore']);
