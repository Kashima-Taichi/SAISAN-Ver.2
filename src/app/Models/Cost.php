<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Cost extends Model
{
    // テーブル設定
    protected $table = 'costs';

    // ホワイトリストの設定
    protected $fillable = [
        'accountName',
        'accountAlpha',
        'price',
        'dependency',
        'business',
        'rakuten',
        'journal',
        'year',
        'month',
        'day',
        'date',
    ];

    // グラフ参照用の経費計上データの取得
    public static function getCostDataForGraph($year, $month) {
        return DB::select('SELECT day, sum(price) dayAmount FROM costs WHERE dependency = 0 AND year = :year AND month = :month GROUP BY day', ['year' => $year, 'month' => $month]);
    }

    // PL出力機能用の経費計上データの取得
    public static function getCostDataForPl($year, $month = null) {
        if ($month !== null) {
            // 月次
            return DB::select('SELECT accountName, sum(price) accountAmount, accountAlpha FROM costs WHERE dependency = 0 AND year = :year AND month = :month GROUP BY accountName, accountAlpha', ['year' => $year, 'month' => $month]);
        } else {
            // 年次
            return DB::select('SELECT accountName, sum(price) accountAmount, accountAlpha FROM costs WHERE dependency = 0 AND year = :year GROUP BY accountName, accountAlpha', ['year' => $year]);
        }
    }

    // 経費計上リスト参照用のデータ取得
    public static function getCostDataForList($year, $month, $day = null, $dependency = false) {
        if ($day !== null) {
            // 日次
            return Cost::whereRaw('dependency = 0 and year = ? and month = ? and day =?', array($year, $month, $day))->get();
        } else {

            // 月次かつ依存経費を参照しない場合
            if ($dependency === false) {
                // 月次
                return Cost::whereRaw('dependency = 0 and year = ? and month = ?', array($year, $month))->get();
            } else {
                // 月次・依存経費参照
                return Cost::whereRaw('year = ? and month = ?', array($year, $month))->get();
            }

        }
    }
}
