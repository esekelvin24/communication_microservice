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






    Route::middleware('api.gateway')->group(function () {


    Route::post('/send_message_to_subscribers/{channel_chat_id}', [App\Http\Controllers\api\v1\CommunicationController::class, 'send_message_to_subscribers'])->name('send_message_to_subscribers');
    Route::post('/set_recieve_reponse_webhook', [App\Http\Controllers\api\v1\CommunicationController::class, 'set_recieve_reponse_webhook'])->name('set_recieve_reponse_webhook');
    Route::post('/unset_recieve_reponse_webhook', [App\Http\Controllers\api\v1\CommunicationController::class, 'unset_recieve_reponse_webhook'])->name('unset_recieve_reponse_webhook');
    
    Route::post('/log_reponse_webhook', [App\Http\Controllers\api\v1\CommunicationController::class, 'log_reponse_webhook'])->name('log_reponse_webhook');

    
     });


