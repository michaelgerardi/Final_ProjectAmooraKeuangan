<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\pemasukan;
use PDF;

class pemasukan_controller extends Controller
{
    public function index_pemasukan(){
        $data_pemasukan = pemasukan::paginate(10);
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

    public function edit_pemasukan(Request $request){
        // $data_pemasukan = pemasukan::find($id_pemasukan);
        // $data_pemasukan = $request->input('tanggal');
        // $data_pemasukan = $request->input('ket_pemasukan');
        // $data_pemasukan = $request->input('nominal');
        pemasukan::where('id_pemasukan',$request->id)->update([
            'tanggal' => $request->tanggal,
            'ket_pemasukkan' => $request->ket_pemasukkan,
            'nominal' => $request->nominal, 
        ]);
        return redirect()->route('pemasukan');
    }

    public function findidpemasukan($id_pemasukan){
        $data_pemasukan = pemasukan::where('id_pemasukan',$id_pemasukan)->first();
        $data = [
            'title' => 'pemasukan',
            'data_pemasukan' => $data_pemasukan
        ];
        return view ('pemasukkan.index', $data);
    }
}
