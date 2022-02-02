<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\pemasukan;
use App\Models\pengeluaran;
use App\Models\jurnal;
use Illuminate\Support\Facades\Schema;

class jurnal_controller extends Controller
{
    public function jurnal(){
        $jurnal = jurnal::orderBy('tgl','asc')->get();
        return view('Jurnal.index',compact('jurnal'));
        //dd($jurnal);
    }

    public function bukubesar(){
        $kas=jurnal::where('ket','=','Kas')->orderBy('tgl', 'asc')->get();
        $pemasukan=jurnal::where([
            ['kredit','!=','0'],
            ['ket','!=','kas']
        ])->orderBy('tgl', 'asc')->get();
        $pengeluaran=jurnal::where([
            ['debit','!=', '0'],
            ['ket','!=','kas']
        ])->orderBy('tgl', 'asc')->get();
        
        //return $pemasukan;
        return view('Jurnal.bukubesar',compact('kas','pengeluaran','pemasukan'));
    }


    public function jurnal_umum(){
        Schema::disableForeignKeyConstraints();
        jurnal::truncate();
        Schema::enableForeignKeyConstraints();
        $pemasukan = pemasukan::all();
        foreach($pemasukan as $pemasukan){
            $kas = new jurnal([
                'tgl' =>$pemasukan['tanggal'],
                'id_pemasukan'=>$pemasukan['id_pemasukan'],
                'ket'=>'kas',
                'debit'=>$pemasukan['nominal']
            ]);
            $kas->save();
            $penjualan = new jurnal([
                'tgl' =>$pemasukan['tanggal'],
                'id_pemasukan'=>$pemasukan['id_pemasukan'],
                'ket'=>$pemasukan['ket_pemasukkan'],
                'kredit'=>$pemasukan['nominal']
            ]);
            $penjualan->save();
        }

        $pengeluaran = pengeluaran::all();
        foreach($pengeluaran as $pengeluaran){
            $beban = new jurnal([
                'tgl'=>$pengeluaran['tgl_pengeluaran'],
                'id_pengeluaran'=>$pengeluaran['id_pengeluaran'],
                'ket'=>$pengeluaran['ket_pengeluaran'],
                'debit'=>$pengeluaran['jml_pengeluaran']
            ]);
            $beban->save();
            $kasbeban = new jurnal([
                'tgl'=>$pengeluaran['tgl_pengeluaran'],
                'id_pengeluaran'=>$pengeluaran['id_pengeluaran'],
                'ket'=>'kas',
                'kredit'=>$pengeluaran['jml_pengeluaran']
            ]);
            $kasbeban->save();
            return redirect()->route('jurnal');
        }
        
    }



}
