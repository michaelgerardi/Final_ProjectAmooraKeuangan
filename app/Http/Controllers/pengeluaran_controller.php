<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\pengeluaran;
use PDF;

class pengeluaran_controller extends Controller
{
    public function index_pengeluaran(){
        $data_pengeluarankewajiban = pengeluaran:: where([
            ['ket_pengeluaran','Kewajiban']
            ])->get()->take(4);
        $data_pengeluaranproduksi = pengeluaran:: where([
            ['ket_pengeluaran','Produksi']
             ])->get()->take(4);  
         $data_pengeluarancust = pengeluaran:: where([
            ['ket_pengeluaran','Customer']
             ])->get()->take(4); 
        return view('Pengeluaran.index',compact('data_pengeluarankewajiban','data_pengeluaranproduksi',
        'data_pengeluarancust'));
        //return $data_pengeluarankewajiban;
    }

    public function tambah_pengeluaran(Request $request){
        \App\Models\pengeluaran::create($request->all());
        //return redirect('sewer')->with('Sukses','Data berhasil ditambahkan');
        dd($request);
    }

    public function download_pengeluarankewajiban(){
        $data_pengeluarankewajiban = pengeluaran:: where([
            ['ket_pengeluaran','Kewajiban']
            ])->get();
        $pdf = PDF::loadview('keluarwajib.pdfkeluarwajib',compact('data_pengeluarankewajiban'));
        return $pdf->download('Laporan Pengeluaran Kewajiban Amoora.pdf');
    }
    public function download_pengeluaranproduksi(){
        $data_pengeluaranproduksi = pengeluaran:: where([
            ['ket_pengeluaran','Produksi']
             ])->get();  
        $pdf = PDF::loadview('keluarproduksi.pdfkeluarproduksi',compact('data_pengeluaranproduksi'));
        return $pdf->download('Laporan Pengeluaran Produksi Amoora.pdf');
    }
    public function download_pengeluarancust(){
        $data_pengeluarancust = pengeluaran:: where([
            ['ket_pengeluaran','Customer']
             ])->get(); 
        $pdf = PDF::loadview('keluarcust.pdfkeluarcust',compact('data_pengeluarancust'));
        return $pdf->download('Laporan Pengeluaran Customer Amoora.pdf');
    }
    public function delete_pengeluaran($id_pengeluaran){
        pengeluaran::where('id_pengeluaran',$id_pengeluaran)->delete();
        return redirect()->back();
    }
}
