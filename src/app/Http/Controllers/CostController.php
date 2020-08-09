<?php

namespace App\Http\Controllers;

use App\Cost;
use Illuminate\Http\Request;

class CostController extends Controller
{
    // APIで経費計上
    public function store(Request $request) {
        $request['date'] = $request['year'] . '-' . (strlen($request['month']) === 1 ? '0' . $request['month'] : $request['month']) . '-' . (strlen($request['day']) === 1 ? '0' . $request['day'] : $request['day']);
        // 経費データの登録
        $costs = new Cost;
        unset($request['_token']);
        $costs->fill($request->all())->save();
        return;
    }

    // 経費計上後のデータ取得
    public function getLatestCostData () {
        return Cost::orderBy('id', 'desc')->first();
    }

    // APIで月次の経費リストを取得
    public function getCostListMonth($year, $month) {
        return Cost::whereRaw('year = ? and month = ?', array($year, $month))->get();
    }

    // APIで日次の経費リストを取得
    public function getCostListDay($year, $month, $day) {
        return Cost::whereRaw('year = ? and month = ? and day =?', array($year, $month, $day))->get();
    }

    // 特定のIDの経費データを取得する
    public function getIndividualCostData($id) {
        return Cost::find($id);
    }

    // 経費明細の修正を実行
    public function edit(Request $request) {
        $request['date'] = $request['year'] . '-' . (strlen($request['month']) === 1 ? '0' . $request['month'] : $request['month']) . '-' . (strlen($request['day']) === 1 ? '0' . $request['day'] : $request['day']);
        $toBeEditedData = Cost::find($request->id);
        unset($request['_token']);
        $toBeEditedData->fill($request->all())->save();
        return;
    }

    // 経費明細の削除
    public function delete($id) {
        $costData = Cost::find($id);
        $costData->delete();
        return;
    }

    // APIで経費計上実績のある年月情報を取得
    public function getCostYear() {
        return Cost::groupBy('year')->get('year');
    }

    public function getCostMonth() {
        return Cost::groupBy('month')->get('month');
    }
}
