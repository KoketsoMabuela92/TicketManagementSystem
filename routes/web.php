<?php

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
    return view('welcome');
});
Route::get('/bad_request', function () {
    return view('badRequest');
});
Route::get('/success_request', function () {
    return view('successful');
});
Route::get('/technical_error', function () {
    return view('technicalError');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/ticket/log', 'TicketController@index')->name('logTicket');
Route::get('/tickets/view', 'TicketController@viewTickets')->name('viewTickets');

Route::post('/ticket/submit', 'TicketController@submitTicket')->name('submitTicket');
