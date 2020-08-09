<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bonus;

class BonusController extends Controller
{
    // 賞与計上実績のある年数の取得
    public function getBonusYear() {
        return Bonus::groupBy('year')->get('year');
    }

    // 賞与計上リストを取得
    public function getBonusListYear($year) {
        return Bonus::whereRaw('year = ?', $year)->get();
    }
}
