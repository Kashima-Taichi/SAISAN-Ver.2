<?php

namespace App\Http\Controllers;

use App\Hour;
use Illuminate\Http\Request;
use DB;

class HourController extends Controller
{
    // APIで稼働時間計上
    public function store(Request $request) {
        $fixedMonth = strlen($request->month) === 1 ? '0' . $request->month : $request->month;
        $concatYearMonth = $request->year . $fixedMonth;
        $hour = new Hour;
        $hours = $request->all();
        $hours['yearMonth'] = $concatYearMonth;
        unset($hours['_token']);
        $hour->fill($hours)->save();
        return;
    }

    // 時間計上後のデータ取得
    public function getLatestHourData() {
        return Hour::orderBy('id', 'desc')->first();
    }

    // APIで年次の稼働時間計上リストを取得
    public function getHourListYear($year) {
        return Hour::whereRaw('year = ?', $year)->get();
    }

    // APIで稼働時間計上実績のある年月情報を取得
    public function getHourYear() {
        return Hour::groupBy('year')->get('year');
    }

    // APIで個別の稼働時間計上データを取得
    public function getIndividualHourData($id) {
        return Hour::find($id);
    }

    // APIで稼働時間計上明細の修正
    public function edit(Request $request) {
        $formContents = $request->all();
        $fixedMonth = strlen($request->month) === 1 ? '0' . $request->month : $request->month;
        $concatYearMonth = $request->year . $fixedMonth;
        $formContents['yearMonth'] = $concatYearMonth;
        unset($formContents['_token']);
        $toBeEditedData = Hour::find($request->id);
        $toBeEditedData->fill($formContents)->save();
        return;
    }

    // APIで稼働時間明細の削除
    public function delete($id) {
        $hourData = Hour::find($id);
        $hourData->delete();
        return;
    }

    // PL出力用のデータ取得(月次)
    public function getMonthlyPlHourData($year, $month) {
        return Hour::select(['fixedTime','overTime'])->whereRaw('year = ? and month = ?', [$year, $month])->first();
    }

    // PL出力用のデータ取得(年次)
    public function getYearlyPlHourData($year) {
        return DB::select('SELECT sum(fixedTime) fixedTime, sum(overTime) overTime FROM hours WHERE year = :year GROUP BY year', ['year' => $year]);
    }
}
