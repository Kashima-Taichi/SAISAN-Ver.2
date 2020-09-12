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

}
