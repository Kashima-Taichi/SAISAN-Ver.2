<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Account;

class AccountController extends Controller
{
    // 勘定科目の登録
    public function store(Request $request) {
        $accounts = new Account;
        unset($request['_token']);
        $accounts->fill($request->all())->save();
        return;
    }

    // 最新の勘定科目データの取得
    public function getLatestAccountData() {
        return Account::orderBy('id', 'desc')->first();
    }

    // 勘定科目のリストを取得
    public function getAccountList() {
        return Account::get('accountKanji');
    }

    // 勘定科目のデータを取得
    public function getAccountsData() {
        return Account::all();
    }

    // 個別の勘定科目のデータを取得
    public function getIndividualAccountData($id) {
        return Account::find($id);
    }

    // 勘定科目データの修正
    public function edit(Request $request) {
        $formContents = $request->all();
        unset($formContents['_token']);
        $toBeEditedData = Account::find($request->id);
        $toBeEditedData->fill($formContents)->save();
        return;
    }
}
