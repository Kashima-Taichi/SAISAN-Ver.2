<?php

namespace App\Http\Controllers;

use App\Cost;
use Illuminate\Http\Request;

class CostController extends Controller
{
    // APIで経費計上
    public function store(Request $request) {
        return Cost::create($request->all());
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

    // APIで経費計上実績のある年月情報を取得
    public function getCostYear() {
        return Cost::groupBy('year')->get('year');
    }
    public function getCostMonth() {
        return Cost::groupBy('month')->get('month');
    }
}
