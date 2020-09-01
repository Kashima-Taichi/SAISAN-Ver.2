<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cost extends Model
{
    // テーブル設定
    protected $table = 'costs';

    // ホワイトリストの設定
    protected $fillable = [
        'accountName',
        'accountAlpha',
        'price',
        'journal',
        'year',
        'month',
        'day',
        'date',
    ];
}
