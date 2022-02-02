<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\pengeluaran;

class pengeluaran_controller extends Controller
{
    public function index_pengeluaran(){
        $data_pengeluaran = pengeluaran::all();
        return view('Pengeluaran.index',compact('data_pengeluaran'));
    }

    public function tambah_pengeluaran(Request $request){
        \App\Models\pengeluaran::create($request->all());
        //return redirect('sewer')->with('Sukses','Data berhasil ditambahkan');
        dd($request);
    }
}
