<?php

namespace App\Http\Controllers;

use App\Hour;
use Illuminate\Http\Request;

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
    public function getLatestHourData () {
        return Hour::orderBy('id', 'desc')->first();
    }
}