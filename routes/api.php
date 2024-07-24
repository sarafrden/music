<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\TrackController;
use App\Http\Controllers\RoyaltyController;
use App\Http\Controllers\DdexController;
use App\Http\Controllers\StreamingAnalyticsController;
use App\Http\Controllers\DistributionChannelController;
use App\Http\Controllers\TrackDistributionController;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('user', [AuthController::class, 'user']);
    Route::post('logout', [AuthController::class, 'logout']);

    Route::apiResource('artists', ArtistController::class);
    Route::apiResource('albums', AlbumController::class);
    Route::apiResource('tracks', TrackController::class);
    Route::apiResource('royalties', RoyaltyController::class);
    Route::apiResource('ddex', DdexController::class);
    Route::apiResource('streaming-analytics', StreamingAnalyticsController::class);
    Route::apiResource('distribution-channels', DistributionChannelController::class);
    Route::apiResource('track-distributions', TrackDistributionController::class);
});


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
