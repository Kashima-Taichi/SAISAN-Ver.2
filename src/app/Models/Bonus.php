<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bonus extends Model
{
    // テーブル設定
    protected $table = 'bonuses';

    // ホワイトリストの設定
    protected $fillable = [
        'totalBonus',
        'healthInsurance',
        'employeePension',
        'employmentInsurance',
        'incomeTax',
        'totalDeduction',
        'netIncome',
        'year',
        'month',
    ];
}
