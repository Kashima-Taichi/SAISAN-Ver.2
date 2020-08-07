<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    // オートインクリメント
    protected $fillable = [
        'accountAlpha',
        'accountKanji',
    ];
}
