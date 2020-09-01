<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    // テーブル設定
    protected $table = 'salaries';

    // ホワイトリストの設定
    protected $fillable = [
        'year',
        'month',
        'yearMonth',
        'totalSalary',
        'basicSalary',
        'overtimePay',
        'healthInsurance',
        'employeePension',
        'employmentInsurance',
        'incomeTax',
        'residentTax',
        'otherDeduction',
        'totalDeduction',
        'netIncome',
    ];
}
