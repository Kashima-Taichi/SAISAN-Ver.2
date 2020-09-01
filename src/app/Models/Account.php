<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    // テーブル設定
    protected $table = 'accounts';

    // ホワイトリストの設定
    protected $fillable = [
        'accountAlpha',
        'accountKanji',
    ];

}
