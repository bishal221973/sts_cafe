<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index(){
        $suppliers=Supplier::latest()->paginate(10);
        $supplier=new Supplier();
        return view('supplier.index',compact('suppliers','supplier'));
    }

    public function store(Request $request){
        $data=$request->validate([
            'name'=>'required',
            'email'=>'nullable',
            'phone'=>'nullable',
            'address'=>'nullable',
            'vat_number'=>'nullable',
        ]);

        Supplier::create($data);

        return redirect()->back()->with('success',"New supplier have been saved.");
    }

    public function edit(Supplier $supplier){
        $suppliers=Supplier::latest()->paginate(10);
        return view('supplier.index',compact('suppliers','supplier'));
    }

    public function update(Request $request,Supplier $supplier){
        $data=$request->validate([
            'name'=>'required',
            'email'=>'nullable',
            'phone'=>'nullable',
            'address'=>'nullable',
            'vat_number'=>'nullable',
        ]);

        $supplier->update($data);

        return redirect()->route('supplier.index')->with('success',"Selected supplier have been changed.");
    }

    public function delete(Supplier $supplier){
        $supplier->delete();

        return redirect()->back()->with("success","Selected supplier have been removed.");
    }
}
