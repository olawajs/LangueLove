<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Code;
use App\Models\Newsletter;
use App\Models\Payment;

class AdministratorController extends Controller
{
    public function Database(Request $request){
        $codes = Code::all();
        $newsletters = Newsletter::all();
        $payments = Payment::orderBy('created_at')->get();
        return view('admin/dataBase',[
            'codes'=> $codes,
            'newsletters'=> $newsletters,
            'payments'=> $payments,
        ]);
    }
}
