<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/*
|--------------------------------------------------------------------------
| 経費関係
|--------------------------------------------------------------------------
| 経費関係のAPIルーティングは下記にて実装する。
*/

// 経費計上
Route::post('/cost/store', 'CostController@store');

// 経費計上後のデータ取得
Route::get('/cost/latest', 'CostController@getLatestCostData');

// 経費計上リスト
Route::get('/cost/list/{year}/{month}', 'CostController@getCostListMonth');
Route::get('/cost/list/{year}/{month}/{day}', 'CostController@getCostListDay');

// 経費計上詳細データ
Route::get('/cost/detail/{id}', 'CostController@getIndividualCostData');

// 経費計上年月の取得
Route::get('/cost/year', 'CostController@getCostYear');
Route::get('/cost/month', 'CostController@getCostMonth');

/*
|--------------------------------------------------------------------------
| 時間関係
|--------------------------------------------------------------------------
| 時間関係のAPIルーティングは下記にて実装する。
*/

// 稼働時間計上
Route::post('/hour/store', 'HourController@store');

// 時間計上後のデータ取得
Route::get('/hour/latest', 'HourController@getLatestHourData');

// 稼働時間計上リスト
Route::get('/hour/list/{year}/', 'HourController@getHourListYear');

// 時間計上年月の取得
Route::get('/hour/year', 'HourController@getHourYear');
