<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bonus;

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
}
