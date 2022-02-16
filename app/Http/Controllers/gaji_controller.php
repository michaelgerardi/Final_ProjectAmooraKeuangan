<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\gaji;
use App\Models\sewer;

class gaji_controller extends Controller
{
    public function index_gaji(){
        $data_penggajian = gaji::all();
        $data_sewer = sewer::all();
        return view('gaji.index',compact('data_penggajian','data_sewer'));
    }

    public function tambah_gaji(Request $request){
    \App\Models\gaji::create($request->all());
    //return redirect('sewer')->with('Sukses','Data berhasil ditambahkan');
    dd($request);
    }
    
    public function edit_gaji(Request $request){
        gaji::where('id_gaji',$request->id)->update([
            'id_sewer' => $request->id_sewer,
            'gaji' => $request->gaji,
            'jenis_gaji' => $request->jenis_gaji,
            'tgl_gaji' => $request->tgl_gaji,
        ]);
        return redirect()->route('penggajian');
    }

    public function findidgaji($id_gaji){
        $data_penggajian = gaji::find($id_gaji);
        $data = [
            'title' => 'gaji',
            'data_penggajian' => $data_penggajian
        ];
        return view ('layouts.editgaji', $data);
    }

    public function deletegaji($id_gaji){
        $data_penggajian = gaji::find($id_gaji);
        $data_penggajian->delete();
        return redirect()->back();
    }

    public function download_gaji(){
        $data_penggajian = gaji::all();
        $pdf = PDF::loadView('layouts.pdfgaji',compact('data_penggajian'));
        return $pdf->download('Laporan Penggajian Amoora.pdf');
    }
    
    
}
