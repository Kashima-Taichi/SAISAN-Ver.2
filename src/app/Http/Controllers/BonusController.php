<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bonus;
use DB;

class BonusController extends Controller
{
    // APIで賞与計上
    public function store(Request $request) {
        // 経費データの登録
        $bonuses = new Bonus;
        unset($request['_token']);
        $bonuses->fill($request->all())->save();
        return;
    }

    // APIで最新の賞与の情報を取得
    public function getLatestBonusData() {
        return Bonus::orderBy('id', 'desc')->first();
    }

    // APIで賞与計上実績のある年数の取得
    public function getBonusYear() {
        return Bonus::groupBy('year')->get('year');
    }

    // APIで賞与計上リストを取得
    public function getBonusListYear($year) {
        return Bonus::whereRaw('year = ?', $year)->get();
    }

    // APIで個別の賞与情報を取得
    public function getIndividualBonusData($id) {
        return Bonus::find($id);
    }

    // APIで計上された賞与の修正
    public function edit(Request $request) {
        $toBeEditedData = Bonus::find($request->id);
        unset($request['_token']);
        $toBeEditedData->fill($request->all())->save();
        return;
    }

    // APIで計上されて賞与の削除
    public function delete($id) {
        $bonusData = Bonus::find($id);
        $bonusData->delete();
        return;
    }

    // APIでPL用の賞与情報を取得(月次)
    public function getMonthlyPlBonusData($year, $month) {
        return Bonus::select(['totalBonus', 'netIncome'])->whereRaw('year = ? and month = ?', [$year, $month])->first();
    }

    // APIでPL用の賞与情報を取得(年次)
    public function getYearlyPlBonusData($year) {
        return DB::select('SELECT sum(totalBonus) totalBonus, sum(netIncome) netIncome FROM bonuses WHERE year = :year GROUP BY year', ['year' => $year]);
    }
}
