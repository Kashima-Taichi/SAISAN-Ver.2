<?php

use Illuminate\Http\Request;

// apiルーティングの制約で使用する配列
$yearMonth = ['year' => '[0-9]+', 'month' => '[0-9]+'];
$year = ['year' => '[0-9]+'];
$id = ['id' => '[0-9]+'];

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

//  "/api/cost/" + this.year + "/" + this.account + "/"

// PL用データの取得(月次)
Route::get('/cost/pl/{year}/{month}/', 'CostController@getMonthlyPlCostData')->where($yearMonth);

// PL用データの取得(年次)
Route::get('/cost/pl/{year}/', 'CostController@getYearlyPlCostData')->where($year);

// 経費計上
Route::post('/cost/store/', 'CostController@store');

// 経費計上後のデータ取得
Route::get('/cost/latest/', 'CostController@getLatestCostData');

// 経費計上リスト(年月)
Route::get('/cost/list/{year}/{month}/', 'CostController@getCostListMonth')->where($yearMonth);

// 依存経費計上リスト(年月)
Route::get('/cost/dependent/{year}/{month}/', 'CostController@getDependentCost')->where($yearMonth);

// 事業経費計上リスト(年月)
Route::get('/cost/business/{year}/{month}/', 'CostController@getBusinessCost')->where($yearMonth);

// 楽天カード決済経費計上リスト(年月)
Route::get('/cost/rakuten/{year}/{month}/', 'CostController@getRakutenCost')->where($yearMonth);

// 経費計上リスト(年月日)
Route::get('/cost/list/{year}/{month}/{day}/', 'CostController@getCostListDay')->where(['year' => '[0-9]+', 'month' => '[0-9]+', 'day' => '[0-9]+']);

// 経費計上詳細データ
Route::get('/cost/detail/{id}/', 'CostController@getIndividualCostData')->where($id);

// 経費計上年の取得
Route::get('/cost/year/', 'CostController@getCostYear');

// 経費計上月の取得
Route::get('/cost/month/', 'CostController@getCostMonth');

// 日別に経費計上金額の推移データを取得
Route::get('/cost/daily/{year}/{month}/', 'CostController@getDailyCostData')->where($yearMonth);

// 科目別経費計上データの取得 (月次)
Route::get('/cost/{year}/{month}/{account}/', 'CostController@getAccountMonthlyCostData')->where(['year' => '[0-9]+', 'month' => '[0-9]+', 'account' => '[a-z]+']);

// 科目別経費計上データの取得 (年次)
Route::get('/cost/{year}/{account}/', 'CostController@getAccountYearlyCostData')->where(['year' => '[0-9]+', 'account' => '[a-z]+']);

// 日別の経費計上合計金額のデータを取得(単月)
Route::get('/cost/amount/daily/{year}/{month}/', 'CostController@getDailyAmountCostData')->where($yearMonth);

// 日別の経費計上合計金額のデータを取得(複数月)
Route::get('/cost/amounts/daily/{year}/{month}/', 'CostController@getDailyAmountsCostData')->where($yearMonth);

// 月別の経費計上合計金額のデータを取得
Route::get('/cost/account/monthly/{year}/{month}/', 'CostController@getMonthlyAccountCostData')->where($yearMonth);

// 科目別月別の経費計上金額データの取得
Route::get('/cost/monthly/{account}/', 'CostController@getMonthlyAccountAmountCostData')->where('account', '[a-z]+');

// 経費計上合計金額の推移(全期間)
Route::get('/cost/amounts/all/', 'CostController@getCostAmountsData');

// 経費明細修正
Route::put('/cost/edit/', 'CostController@edit');

// 経費明細削除
Route::delete('/cost/delete/{id}/', 'CostController@delete')->where($id);


/*
|--------------------------------------------------------------------------
| 時間関係
|--------------------------------------------------------------------------
| 時間関係のAPIルーティングは下記にて実装する。
*/

// PL用データの取得(月次)
Route::get('/hour/pl/{year}/{month}/', 'HourController@getMonthlyPlHourData')->where($yearMonth);

// PL用データの取得(年次)
Route::get('/hour/pl/{year}/', 'HourController@getYearlyPlHourData')->where($year);

// 稼働時間計上
Route::post('/hour/store/', 'HourController@store');

// 時間計上後のデータ取得
Route::get('/hour/latest/', 'HourController@getLatestHourData');

// 稼働時間計上リスト
Route::get('/hour/list/{year}/', 'HourController@getHourListYear')->where($year);

// 時間計上年月の取得
Route::get('/hour/year/', 'HourController@getHourYear');

// 個別の時間計上データを取得
Route::get('/hour/detail/{id}/', 'HourController@getIndividualHourData')->where($id);

// 稼働時間明細修正
Route::put('/hour/edit/', 'HourController@edit');

// 稼働時間明細削除
Route::delete('/hour/delete/{id}/', 'HourController@delete')->where($id);


/*
|--------------------------------------------------------------------------
| 収入関係
|--------------------------------------------------------------------------
| 収入関係のAPIルーティングは下記にて実装する。
*/

// PL用データの取得(月次)
Route::get('/salary/pl/{year}/{month}/', 'SalaryController@getMonthlyPlSalaryData')->where($yearMonth);

// PL用データの取得(年次)
Route::get('/salary/pl/{year}/', 'SalaryController@getYearlyPlSalaryData')->where($year);

// 収入計上
Route::post('/salary/store/', 'SalaryController@store');

// 収入計上後のデータ取得
Route::get('/salary/latest/', 'SalaryController@getLatestSalaryData');

// 稼働時間計上リスト
Route::get('/salary/list/{year}/', 'SalaryController@getSalaryListYear')->where($year);

// 収入計上年月の取得
Route::get('/salary/year/', 'SalaryController@getSalaryYear');

// 個別の収入情報を取得
Route::get('/salary/detail/{id}/', 'SalaryController@getIndividualSalaryData')->where($id);

// グラフ参照機能用の総支給学と手取り額のデータを取得
Route::get('/salary/all/', 'SalaryController@getAllSalaryData');

// グラフ参照機能用の純利益データの取得
Route::get('/salary/profit/', 'SalaryController@getAllProfitData');

// 所得明細修正
Route::put('/salary/edit/', 'SalaryController@edit');

// 所得明細削除
Route::delete('/salary/delete/{id}/', 'SalaryController@delete')->where($id);


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

// 個別の勘定科目データの参照
Route::get('/account/detail/{id}/', 'AccountController@getIndividualAccountData')->where($id);

// 勘定科目情報の修正
Route::put('/account/edit/', 'AccountController@edit');

// 勘定科目明細の削除
Route::delete('/account/delete/{id}/', 'AccountController@delete')->where($id);


/*
|--------------------------------------------------------------------------
| 賞与関係
|--------------------------------------------------------------------------
| 賞与関係のAPIルーティングは下記にて実装する。
*/

// PL用データの取得(月次)
Route::get('/bonus/pl/{year}/{month}/', 'BonusController@getMonthlyPlBonusData')->where($yearMonth);

// PL用データの取得(年次)
Route::get('/bonus/pl/{year}/', 'BonusController@getYearlyPlBonusData')->where($year);

// 賞与計上
Route::post('/bonus/store/', 'BonusController@store');

// 最新の賞与データの取得
Route::get('/bonus/latest/', 'BonusController@getLatestBonusData');

// 賞与計上実績のある年を取得する
Route::get('/bonus/year/', 'BonusController@getBonusYear');

// 賞与計上実績を取得する
Route::get('/bonus/list/{year}/', 'BonusController@getBonusListYear')->where($year);

// 個別の賞与情報を取得
Route::get('/bonus/detail/{id}/', 'BonusController@getIndividualBonusData')->where($id);

// 計上された賞与の修正
Route::put('/bonus/edit/', 'BonusController@edit');

// 計上された賞与の削除
Route::delete('/bonus/delete/{id}/', 'BonusController@delete')->where($id);
