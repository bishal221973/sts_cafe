<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index(){
        return view('layouts.setting');
    }

    public function syncSetting(Request $request){
        $request->validate([
            'app_name' => 'required',
            'print_app_name' => 'required',
            'address' => 'required',
            'vat' => 'required',
            'sn_prefix' => 'required',
        ]);
        settings()->set([
            'app_name' => $request->app_name,
            'print_app_name' => $request->print_app_name,
            'address' => $request->address,
            'vat' => $request->vat,
            'sn_prefix' => $request->sn_prefix,
         ]);

         return redirect()->back()->with('success',"Sytteng changed.");
    }
}
