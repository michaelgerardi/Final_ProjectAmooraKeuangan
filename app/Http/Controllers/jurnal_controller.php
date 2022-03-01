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

    public function labarugi($bln,$year){
        $up="";
        $down="";
        switch ($bln) {
            case '1':
                $up=$year."-01-01";
                $down=$year."-01-31";
                break;
            case '2':
                $up=$year."-02-01";
                $down=$year."-02-31";
                break;
            case '3':
                $up=$year."-03-01";
                $down=$year."-03-31";
                break;
            case '4':
                $up=$year."-04-01";
                $down=$year."-04-31";
                break;
            case '5':
                $up=$year."-05-01";
                $down=$year."-05-31";
                break;
            case '6':
                $up=$year."-06-01";
                $down=$year."-06-31";
                break;
            case '7':
                $up=$year."-07-01";
                $down=$year."-07-31";
                break;
            case '8':
                $up=$year."-08-01";
                $down=$year."-08-31";
                break;
            case '9':
                $up=$year."-09-01";
                $down=$year."-09-31";
                break;
            case '10':
                $up=$year."-10-01";
                $down=$year."-10-31";
                break;
            case '11':
                $up=$year."-11-01";
                $down=$year."-11-31";
                break;
            case '12':
                $up=$year."-12-01";
                $down=$year."-12-31";
                break;
            default:
                $up=$year."-01-01";
                $down=$year."-01-31";
                break;
        }
        $laba_masuk = pemasukan::selectraw("sum(nominal) as nominal,DATE_FORMAT(tanggal,'%m') as month")->groupby('month')->get();
        $masuk = pemasukan::where([
            ['tanggal','>=',$up],
            ['tanggal','<=',$down],
            ])->get();
        $keluar = pengeluaran::where([
            ['tgl_pengeluaran','>=',$up],
            ['tgl_pengeluaran','<=',$down],
            ])->get();
// <<<<<<< HEAD
        //$laba_rugi =  pengeluaran::selectraw("sum(jml_pengeluaran) as nominal,DATE_FORMAT(tgl_pengeluaran,'%m') as month")->groupby('month')->get();
        $keluartot = pengeluaran::where([
            ['tgl_pengeluaran','>=',$up],
            ['tgl_pengeluaran','<=',$down],
            ])->sum('jml_pengeluaran');
        $masuktot = pemasukan::where([
            ['tanggal','>=',$up],
            ['tanggal','<=',$down],
            ])->sum('nominal');
        $realngentood=$masuktot-$keluartot;
        return view('labarugi.index',compact('keluartot','laba_masuk','masuk','keluar','realngentood'));
        //return $keluartot;
// =======
        $laba_rugi =  pengeluaran::selectraw("sum(jml_pengeluaran) as nominal,DATE_FORMAT(tgl_pengeluaran,'%m') as month")->groupby('month')->get();
        return view('labarugi.index',compact('laba_rugi','laba_masuk','masuk','keluar'));
        //return $keluar;
// >>>>>>> 0bb3ce7c398c99f556806edbb3e0badd9b414b63
    }



}