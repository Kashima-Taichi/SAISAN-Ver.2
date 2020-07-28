<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cost extends Model
{
    // テーブル設定
    protected $table = 'costs';

    // ホワイトリストの設定
    protected $fillable = [
        'accountName',
        'price',
        'journal',
        'year',
        'month',
        'day',
        'date',
    ];
}
