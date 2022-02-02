<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\pemasukan;

class pemasukan_controller extends Controller
{
    public function index_pemasukan(){
        $data_pemasukan = pemasukan::all();
        return view('Pemasukkan.index',compact('data_pemasukan'));
    }

    public function tambah_pemasukan(Request $request){
        \App\Models\pemasukan::create($request->all());
        //return redirect('sewer')->with('Sukses','Data berhasil ditambahkan');
        dd($request);
    }
}
