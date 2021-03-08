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

}
