<?php

use App\Http\Controllers\ChatsController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
//    event(new \App\Events\WebsocketDemoEvent('some event data'));
    broadcast(new \App\Events\WebsocketDemoEvent('some broadcast data'));
    return view('welcome');

});

Route::get('/test', function () {
    return event(new \App\Events\WebsocketDemoEvent('some data'));
});


Route::get('/chats' , [ChatsController::class , 'index']);
Route::get('/messages' , [ChatsController::class , 'fetchMessages']);
Route::post('/messages' , [ChatsController::class , 'sendMessage']);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/websocket/serve', function () {
    Artisan::call('websocket:serve');
});
