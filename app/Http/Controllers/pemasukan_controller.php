<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\pemasukan;
use PDF;

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

    public function download_pemasukan(){
        $data_pemasukan = pemasukan::all();
        $pdf = PDF::loadView('downloadmasuk.pdfpemasukan',compact('data_pemasukan'));
        return $pdf->download('Laporan Pemasukkan Amoora.pdf');
    }

    public function delete_pemasukan($id_pemasukan){
        pemasukan::where('id_pemasukan',$id_pemasukan)->delete();
        return redirect()->back();
    }
}
