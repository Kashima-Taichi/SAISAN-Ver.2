<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Salary;

class SalaryController extends Controller
{
    // APIで所得の計上
    public function store(Request $request) {
        $salary = new Salary;
        $formContents = $request->all();
        $fixedMonth = strlen($request->month) === 1 ? '0' . $request->month : $request->month;
        $concatYearMonth = $request->year . $fixedMonth;
        $formContents['yearMonth'] = $concatYearMonth;
        unset($formContents['_token']);
        $salary->fill($formContents)->save();
        return;
    }

    // 最新の所得データの取得
    public function getLatestSalaryData() {
        return Salary::orderBy('id', 'desc')->first();
    }
}
