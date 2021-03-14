<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Capital;
use DB;

class CapitalController extends Controller
{
    // 資産評価額の計上
    public function store(Request $request) {
        $capital = new Capital;
        unset($request['_token']);
        $capital->fill($request->all())->save();
        return;
    }

    // 資産評価額計上後のデータ取得
    public function getLatestData() {
        //TODO 謎にhtmlが返ってくる
        return Capital::orderBy('id', 'desc')->first();
    }

    // APIで資産評価額計上実績のある年数の取得
    public function getCapitalYear() {
        return Capital::groupBy('year')->get('year');
    }

    // APIで資産評価額計上リストを取得
    public function getCapitalListYear($year) {
        return Capital::whereRaw('year = ?', $year)->get();
    }

}
