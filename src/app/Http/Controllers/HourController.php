<?php

namespace App\Http\Controllers;

use App\Hour;
use Illuminate\Http\Request;

class HourController extends Controller
{
    // APIで稼働時間計上
    public function store(Request $request) {
        return Hour::create($request->all());
    }
}
