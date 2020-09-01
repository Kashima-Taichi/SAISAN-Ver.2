<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hour extends Model
{
    //テーブル設定
    protected $table = 'hours';

    // ホワイトリストの設定
    protected $fillable = [
        'year',
        'month',
        'yearMonth',
        'fixedTime',
        'overTime',
    ];
}
