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
Route::post('/cost/store/', 'CostController@store');

// 経費計上後のデータ取得
Route::get('/cost/latest/', 'CostController@getLatestCostData');

// 経費計上リスト
Route::get('/cost/list/{year}/{month}/', 'CostController@getCostListMonth');
Route::get('/cost/list/{year}/{month}/{day}/', 'CostController@getCostListDay');

// 経費計上詳細データ
Route::get('/cost/detail/{id}/', 'CostController@getIndividualCostData');

// 経費計上年月の取得
Route::get('/cost/year/', 'CostController@getCostYear');
Route::get('/cost/month/', 'CostController@getCostMonth');

// 経費明細修正
Route::put('/cost/edit/', 'CostController@edit');

// 経費明細削除
Route::delete('/cost/delete/{id}/', 'CostController@delete');

/*
|--------------------------------------------------------------------------
| 時間関係
|--------------------------------------------------------------------------
| 時間関係のAPIルーティングは下記にて実装する。
*/

// 稼働時間計上
Route::post('/hour/store/', 'HourController@store');

// 時間計上後のデータ取得
Route::get('/hour/latest/', 'HourController@getLatestHourData');

// 稼働時間計上リスト
Route::get('/hour/list/{year}/', 'HourController@getHourListYear');

// 時間計上年月の取得
Route::get('/hour/year/', 'HourController@getHourYear');

/*
|--------------------------------------------------------------------------
| 収入関係
|--------------------------------------------------------------------------
| 収入関係のAPIルーティングは下記にて実装する。
*/

// 収入計上
Route::post('/salary/store/', 'SalaryController@store');

// 収入計上後のデータ取得
Route::get('/salary/latest/', 'SalaryController@getLatestSalaryData');

// 稼働時間計上リスト
Route::get('/salary/list/{year}/', 'SalaryController@getSalaryListYear');

// 収入計上年月の取得
Route::get('/salary/year/', 'SalaryController@getSalaryYear');

// 個別の収入情報を取得
Route::get('/salary/detail/{id}/', 'SalaryController@getIndividualSalaryData');

/*
|--------------------------------------------------------------------------
| 勘定科目関係
|--------------------------------------------------------------------------
| 勘定科目関係のAPIルーティングは下記にて実装する。
*/

// 勘定科目の登録
Route::post('/account/store/', 'AccountController@store');

// 最新の勘定科目データの取得
Route::get('/account/latest/', 'AccountController@getLatestAccountData');

// 勘定科目のリストを取得 (経費計上用)
Route::get('/account/list/', 'AccountController@getAccountList');

// 勘定科目のリストを取得 (勘定科目ページ参照用)
Route::get('/account/all/', 'AccountController@getAccountsData');

/*
|--------------------------------------------------------------------------
| 賞与関係
|--------------------------------------------------------------------------
| 賞与関係のAPIルーティングは下記にて実装する。
*/

// 賞与計上実績のある年を取得する
Route::get('/bonus/year/', 'BonusController@getBonusYear');

// 賞与計上実績を取得する
Route::get('/bonus/list/{year}/', 'BonusController@getBonusListYear');
