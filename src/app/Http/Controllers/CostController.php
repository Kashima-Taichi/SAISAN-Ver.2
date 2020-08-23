<?php

namespace App\Http\Controllers;

use App\Cost;
use App\Account;
use Illuminate\Http\Request;
use DB;

class CostController extends Controller
{
    // 経費計上
    public function store(Request $request) {
        // date情報の設定
        $request['date'] = $request['year'] . '-' . (strlen($request['month']) === 1 ? '0' . $request['month'] : $request['month']) . '-' . (strlen($request['day']) === 1 ? '0' . $request['day'] : $request['day']);
        // アルファベットの科目名の設定
        $accountAlpha = Account::select('accountAlpha')->whereRaw('accountKanji = ?', $request['accountName'])->first();
        $request['accountAlpha'] = $accountAlpha->accountAlpha;
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

    // 月次の経費リストを取得
    public function getCostListMonth($year, $month) {
        return Cost::whereRaw('year = ? and month = ?', array($year, $month))->get();
    }

    // 日次の経費リストを取得
    public function getCostListDay($year, $month, $day) {
        return Cost::whereRaw('year = ? and month = ? and day =?', array($year, $month, $day))->get();
    }

    // 特定のIDの経費データを取得する
    public function getIndividualCostData($id) {
        return Cost::find($id);
    }

    // 経費明細の修正を実行
    public function edit(Request $request) {
        // date情報の設定
        $request['date'] = $request['year'] . '-' . (strlen($request['month']) === 1 ? '0' . $request['month'] : $request['month']) . '-' . (strlen($request['day']) === 1 ? '0' . $request['day'] : $request['day']);
        // アルファベットの科目名の設定
        $accountAlpha = Account::select('accountAlpha')->whereRaw('accountKanji = ?', $request['accountName'])->first();
        $request['accountAlpha'] = $accountAlpha->accountAlpha;
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

    // 経費計上実績のある年情報を取得
    public function getCostYear() {
        return Cost::groupBy('year')->get('year');
    }

    // 経費計上実績のある月情報を取得
    public function getCostMonth() {
        return Cost::groupBy('month')->get('month');
    }

    // PL用の経費計上データを取得(月次)
    public function getMonthlyPlCostData($year, $month) {
        return DB::select('SELECT accountName, sum(price) accountAmount, accountAlpha FROM costs WHERE year = :year AND month = :month GROUP BY accountName, accountAlpha', ['year' => $year, 'month' => $month]);
    }

    // PL用の経費計上データを取得(年次)
    public function getYearlyPlCostData($year) {
        return DB::select('SELECT accountName, sum(price) accountAmount, accountAlpha FROM costs WHERE year = :year GROUP BY accountName, accountAlpha', ['year' => $year]);
    }

    // 勘定科目別の経費計上データの取得
    public function getAccountCostData($year, $month, $account) {
        return Cost::select(['id', 'accountName', 'price', 'journal', 'day'])->whereRaw('year = ? and month = ? and accountAlpha =?', array($year, $month, $account))->get();
    }

    // 日別の経費計上合計金額を取得(単月)
    public function getDailyAmountCostData($year, $month) {
        $param = ['year' => $year, 'month' => $month];
        $lineGraphData = DB::select('SELECT day, sum(price) dayAmount FROM costs WHERE year = :year AND month = :month GROUP BY day', $param);
        foreach ($lineGraphData as $key => $value) {
            if ($key !== 0) {
                $lineGraphData[$key]->dayAmount = $lineGraphData[$key-1]->dayAmount + $lineGraphData[$key]->dayAmount;
            }
        }
        return $lineGraphData;
    }

    // 日別の経費計上合計金額を取得(複数月)
    public function getDailyAmountsCostData($year, $month) {
        $param = ['year' => $year, 'month' => $month];
        // 選択月
        $lineGraphData['selected'] = DB::select('SELECT day, sum(price) dayAmount FROM costs WHERE year = :year AND month = :month GROUP BY day', $param);
        foreach ($lineGraphData['selected'] as $key => $value) {
            if ($key !== 0) {
                $lineGraphData['selected'][$key]->dayAmount = $lineGraphData['selected'][$key-1]->dayAmount + $lineGraphData['selected'][$key]->dayAmount;
            }
        }
        // 選択月マイナス1月
        $lineGraphData['minus'] = DB::select('SELECT day, sum(price) dayAmount FROM costs WHERE year = :year AND month = :month - 1 GROUP BY day', $param);
        foreach ($lineGraphData['minus'] as $key => $value) {
            if ($key !== 0) {
                $lineGraphData['minus'][$key]->dayAmount = $lineGraphData['minus'][$key-1]->dayAmount + $lineGraphData['minus'][$key]->dayAmount;
            }
        }
        return $lineGraphData;
    }

    // 日別の経費計上金額の推移データの取得
    public function getDailyCostData($year, $month) {
        $param = ['year' => $year, 'month' => $month];
        $lineGraphData = DB::select('SELECT day, sum(price) dayAmount FROM costs WHERE year = :year AND month = :month GROUP BY day', $param);
        return $lineGraphData;
    }

    public function getMonthlyAccountCostData($year, $month) {
        $param = ['year' => $year, 'month' => $month];
        $lineGraphData = DB::select('SELECT accountName, sum(price) accountAmount FROM costs WHERE year = :year AND month = :month GROUP BY accountName', $param);
        return $lineGraphData;
    }
}
