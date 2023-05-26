<?php

use App\Http\Controllers\MemberController;
use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/addmember', [MemberController::class, 'create']);    
Route::get('/destroymember', [MemberController::class, 'destroy']); 
Route::get('/getmemberdetails', [MemberController::class, 'memberdetail']);   
Route::post('/updatemember', [MemberController::class, 'update']);    
Route::get('/getmember', [MemberController::class, 'getmember']);  