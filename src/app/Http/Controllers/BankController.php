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

    // APIで個別の銀行の預金残高を取得
    public function getIndividualBankData($id) {
        return Bank::find($id);
    }

    // APIで個別の銀行の預金残高を修正
    public function edit(Request $request) {
        $toBeEditedData = Bank::find($request->id);
        unset($request['_token']);
        $toBeEditedData->fill($request->all())->save();
        return;
    }
}
