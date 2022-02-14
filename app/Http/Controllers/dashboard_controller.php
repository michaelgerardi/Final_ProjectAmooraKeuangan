<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sewer;
use App\Models\pemasukan;
use App\Models\pengeluaran;

class dashboard_controller extends Controller
{
    public function index_dashboard(){
        $total_pemasukan = pemasukan::select(pemasukan::raw('sum(nominal) as pemasukan'))->first();
        $grafikkeluar = pengeluaran::selectraw("sum(jml_pengeluaran) as nominal,DATE_FORMAT(tgl_pengeluaran,'%m') as month")->groupby('month')->get();
        $bulankeluar = pengeluaran::selectraw("DATE_FORMAT(tgl_pengeluaran,'%M')as month")->groupby('month')->get();
        $bulanmasuk = pemasukan::selectraw("DATE_FORMAT(tanggal,'%M')as month")->groupby('month')->get();
        $grafikmasuk = pemasukan::selectraw("sum(nominal) as nominal,DATE_FORMAT(tanggal,'%m') as month")->groupby('month')->get();
        $total_pengeluaran = pengeluaran::select(pengeluaran::raw('sum(jml_pengeluaran) as pengeluaran'))->first();
        $total_pegawai = sewer::select(sewer::raw('count(id_sewer) as pegawai'))->first();
        
        //return $bulankeluar;
        return view('Dashboard.index',compact('total_pemasukan','total_pengeluaran','total_pegawai','grafikkeluar','grafikmasuk','bulankeluar','bulanmasuk'));
    }

    public function grafik_pemasukan(){

    }

    public function grafik_pengeluaran(){
        
    }

   
        
    
}
