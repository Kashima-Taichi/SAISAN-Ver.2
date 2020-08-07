<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Account;

class AccountController extends Controller
{
    // 勘定科目のリストを取得
    public function getAccountList() {
        return Account::all();
    }
}
