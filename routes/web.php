<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DatatrafikController;
use App\Http\Controllers\DataChannelController;
use App\Http\Controllers\InputformController;
use App\Http\Controllers\PercentTrafficController;
use App\Http\Controllers\LineServiceController;
use App\Http\Controllers\DashboardMTDController;
use App\Http\Controllers\OtentikasiController;
use App\Http\Controllers\DashboardController;
use App\Http\Middleware\SessionLogin;
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
Route::post('/', 'OtentikasiController@login')->name('login');
Route::get('/','OtentikasiController@index')->name('login');


// Route::group(['middleware' =>  'SessionLogin'], function() {
    Route::group(['middleware' =>  'auth'], function() {
    Route::get('/index/','InputformController@index')->name('index');
    Route::post('create','InputformController@create');
    Route::get('dataTraffic','InputformController@dataTraffic');
    Route::get('/Channel/','DataChannelController@index')->name('index.channel');
    Route::post('create_channel','DataChannelController@create')->name('create.channel');
    // Route::get('DashboardCR','InputformController@indexTraffic')->name('indexTraffic');
    Route::get('Dashboard','DashboardController@index')->name('dashboard.index');
    Route::get('/filter/','DashboardController@filter')->name('dashboard.filter');
    Route::get('param_view','InputformController@paramterView')->name('param.view');
    Route::get('/dataCR/','InputformController@datacr')->name('index.cr');
    Route::get('/percent/','PercentTrafficController@All_ticket')->name('percent.index');
    Route::get('/ticket/','AllTicketController@index')->name('ticket.index');
    Route::post('CreateTicket','AllTicketController@create')->name('ticket.create');
    Route::post('create_percent','PercentTrafficController@create')->name('percent.create');
    Route::get('/index_service/', 'LineServiceController@indexService')->name('line.service');
    Route::post('Create_service','LineServiceController@create')->name('line.create');
    Route::get('dashboard_mtd','DashboarMTDController@index')->name('mtd.index');
    Route::get('targetCR','InputformController@targetCR')->name('targetCR.index');
    Route::get('/logout', 'OtentikasiController@logout')->name('logout');

});
