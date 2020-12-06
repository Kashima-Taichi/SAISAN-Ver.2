<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    // テーブル設定
    protected $table = 'banks';

    // ホワイトリストの設定
    protected $fillable = [
        'id',
        'bank_id',
        'bank_name',
        'balance',
    ];
}
