<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bank;
use DB;

class BankController extends Controller
{
    //APIで銀行の預金残高の取得
    public function getAllBankData() {
        return Bank::select(['id', 'bank_id', 'bank_name', 'balance'])->get();
    }
}
