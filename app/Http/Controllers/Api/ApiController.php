<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\People;
use App\Models\Shiporder;

class ApiController extends Controller
{

    public function getPeople(Request $request) {
        $input = $request->all();
        return People::filter($input)->with('phones')->get();
    }

    public function getShiporder(Request $request) {
        $input = $request->all();
        return Shiporder::with('itens')->with('shipto')->with('person')->get();
    }

}