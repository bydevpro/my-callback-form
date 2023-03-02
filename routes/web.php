<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

route::name('user.')->group(function(){
    Route::view ('/callback','callbackform')->middleware('auth')->name('callback');
    Route::view ('/admin','admin')->middleware('auth')->name('admin');
    Route::get('/login', function(){
        if(Auth::check()){
            return redirect (route('user.callback'));
        }
        return view('login');
    })->name('login');
    Route::post('/registration', [\App\Http\Controllers\RegisterController::class, 'registrator'])->name('registration');

    Route::post('/login', [\App\Http\Controllers\LoginController::class, 'login']);
    Route::get('/logout', function(){
        Auth::logout();
        return redirect ('/login');
    });
    //Route::get ('register')

});
