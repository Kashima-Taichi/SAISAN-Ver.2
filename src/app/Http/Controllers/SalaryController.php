<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Salary;
use DB;

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

    // 所得計上実績のある年数を取得
    public function getSalaryYear() {
        return Salary::groupBy('year')->get('year');
    }

    // APIで年次の所得計上リストを取得
    public function getSalaryListYear($year) {
        return Salary::whereRaw('year = ?', $year)->get();
    }

    // APIで個別の所得の情報を取得
    public function getIndividualSalaryData($id) {
        return Salary::find($id);
    }

    // APIで所得の修正
    public function edit(Request $request) {
        $formContents = $request->all();
        $fixedMonth = strlen($request->month) === 1 ? '0' . $request->month : $request->month;
        $concatYearMonth = $request->year . $fixedMonth;
        $formContents['yearMonth'] = $concatYearMonth;
        unset($formContents['_token']);
        $toBeEditedData = Salary::find($request->id);
        $toBeEditedData->fill($formContents)->save();
        return;
    }

    // APIで所得明細の削除
    public function delete($id) {
        $salaryData = Salary::find($id);
        $salaryData->delete();
        return;
    }

    // PL用のデータ取得(月次)
    public function getMonthlyPlSalaryData($year, $month) {
        return Salary::select(['totalSalary','netIncome'])->whereRaw('year = ? and month = ?', [$year, $month])->first();
    }

    // PL用のデータ取得(年次)
    public function getYearlyPlSalaryData($year) {
        return DB::select('SELECT sum(totalSalary) totalSalary, sum(netIncome) netIncome FROM salaries WHERE year = :year GROUP BY year', ['year' => $year]);
    }

    // グラフ参照用の収入情報の取得
    public function getAllSalaryData() {
        return Salary::select(['totalSalary','netIncome', 'yearMonth'])->get();
    }
}
