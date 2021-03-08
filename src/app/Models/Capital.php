<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Capital extends Model
{
    // テーブル設定
    protected $table = 'capitals';

    // ホワイトリストの設定
    protected $fillable = [
        'year',
        'month',
        'total',
        'cash',
    ];
}
