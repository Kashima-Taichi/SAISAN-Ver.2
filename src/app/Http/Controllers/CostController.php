<?php

namespace App\Http\Controllers;

use App\Cost;
use Illuminate\Http\Request;

class CostController extends Controller
{
    // APIで経費計上
    public function store(Request $request) {
        return Cost::create($request->all());
    }
}
