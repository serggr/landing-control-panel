<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TesterController extends Controller
{
    
    public function index() {


        $testers = DB::table('testers')->paginate(1); 
        //dd($testers);
        return view('tester', ['testers'=>$testers]);


    }
}
