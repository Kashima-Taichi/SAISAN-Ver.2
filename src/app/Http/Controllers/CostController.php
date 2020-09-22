<?php

namespace App\Http\Controllers;

use App\Models\Cost;
use App\Models\Account;
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
        return Cost::getCostDataForList($year, $month);
    }

    // 日次の経費リストを取得
    public function getCostListDay($year, $month, $day) {
        return Cost::getCostDataForList($year, $month, $day);
    }

    // 依存経費データを取得
    public function getDependentCost($year, $month) {
        return Cost::whereRaw('dependency = 1 and year = ? and month = ?', array($year, $month))->get();
    }

    // ビジネス経費データを取得
    public function getBusinessCost($year, $month) {
        return Cost::whereRaw('business = 1 and year = ? and month = ?', array($year, $month))->get();
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
        return Cost::getCostDataForPl($year, $month);
    }

    // PL用の経費計上データを取得(年次)
    public function getYearlyPlCostData($year) {
        return Cost::getCostDataForPl($year);
    }

    // 勘定科目別の経費計上データの取得
    public function getAccountMonthlyCostData($year, $month, $account) {
        return Cost::select(['id', 'accountName', 'price', 'journal', 'day'])->whereRaw('dependency = 0 and year = ? and month = ? and accountAlpha =?', array($year, $month, $account))->get();
    }

    // 勘定科目別の経費計上データの取得
    public function getAccountYearlyCostData($year, $account) {
        return Cost::select(['id', 'accountName', 'price', 'journal', 'day'])->whereRaw('dependency = 0 and year = ? and accountAlpha =?', array($year, $account))->get();
    }

    public function getMonthlyAccountCostData($year, $month) {
        $param = ['year' => $year, 'month' => $month];
        $lineGraphData = DB::select('SELECT accountName, sum(price) accountAmount FROM costs WHERE dependency = 0 AND year = :year AND month = :month GROUP BY accountName', $param);
        return $lineGraphData;
    }

    public function getMonthlyAccountAmountCostData($account) {
        $lineGraphData = DB::select('SELECT concat(year,month) timeStamp, sum(price) accountAmount FROM costs WHERE dependency = 0 AND accountAlpha = :account group by year, month, accountAlpha', ['account' => $account]);
        return $lineGraphData;
    }

    public function getCostAmountsData() {
        $lineGraphData = DB::select('SELECT year, month, sum(price) AS sum FROM costs WHERE dependency = 0 GROUP BY year, month');
        return $lineGraphData;
    }

    // 日別の経費計上合計金額を取得(単月)
    public function getDailyAmountCostData($year, $month) {
        $lineGraphData = Cost::getCostDataForGraph($year, $month);
        foreach ($lineGraphData as $key => $value) {
            if ($key !== 0) {
                $lineGraphData[$key]->dayAmount = $lineGraphData[$key-1]->dayAmount + $lineGraphData[$key]->dayAmount;
            }
        }
        return $lineGraphData;
    }

    // 日別の経費計上合計金額を取得(複数月)
    public function getDailyAmountsCostData($year, $month) {
        // TODO 1月の場合の実装を考える必要があった
        // 選択月
        $lineGraphData['selected'] = Cost::getCostDataForGraph($year, $month);
        foreach ($lineGraphData['selected'] as $key => $value) {
            if ($key !== 0) {
                $lineGraphData['selected'][$key]->dayAmount = $lineGraphData['selected'][$key-1]->dayAmount + $lineGraphData['selected'][$key]->dayAmount;
            }
        }
        // 選択月マイナス1月
        $lineGraphData['minus'] = Cost::getCostDataForGraph($year, $month - 1);
        foreach ($lineGraphData['minus'] as $key => $value) {
            if ($key !== 0) {
                $lineGraphData['minus'][$key]->dayAmount = $lineGraphData['minus'][$key-1]->dayAmount + $lineGraphData['minus'][$key]->dayAmount;
            }
        }
        return $lineGraphData;
    }

    // 日別の経費計上金額の推移データの取得
    public function getDailyCostData($year, $month) {
        return Cost::getCostDataForGraph($year, $month);
    }
}
