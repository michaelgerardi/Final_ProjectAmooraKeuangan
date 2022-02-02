<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\sewer;
use App\Models\gaji;
use PDF;

class sewer_controller extends Controller
{
    public function index_sewer(){
        $data_sewer = sewer::all();
        return view('sewer.index',compact('data_sewer'));
    }

    public function tambah_sewer(Request $request){
        \App\Models\sewer::create($request->all());
        // /$request->validate([
        //     'nip' => 'required',
        //     'nama' => 'required',
        //     'tgl_lahir' => 'required',
        //     'alamat' => 'required',
        //     'no_hp' => 'required',
        //     'jenis_kelamin' => 'required',
        //     'posisi' => 'required',
        //     'image' => 'required',
        // ]);
        // $post = new Post();
        // $post->post_title = $request->post_title;
        // $post->category = $request->category;
        // if ($request->hasFile('image')) {
        //     $image = $request->file('image');
        //     $name = rand(1000, 9999) . $image->getClientOriginalName();
        //     $image->move('images/post', $name);
        //     $post->image = $name;
        // }
        // $post->content = $request->content;
        // $post->save();
        return redirect('sewer')->with('Sukses','Data berhasil ditambahkan');
      
    }

    public function edit_sewer($id_sewer, Request $request){
        // $data_sewer = sewer::find($id_sewer);
        // $data_sewer = $request->input('nip');
        // $data_sewer = $request->input('nama');
        // $data_sewer = $request->input('tgl_lahir');
        // $data_sewer = $request->input('alamat');
        // $data_sewer = $request->input('no_hp');
        // $data_sewer = $request->input('jenis_kelamin');
        // $data_sewer = $request->input('gaji');
        // $data_sewer = $request->input('posisi');
        return redirect()->route('sewer');
    }

    public function findidsewer($id_sewer){
        $data_sewer = sewer::find($id_sewer);
        $data = [
            'title' => 'sewer',
            'data_sewer' => $data_sewer
        ];
        return view ('layouts.editsewer', $data);
    }

    public function deletesewer($id_sewer){
        $data_sewer = sewer::find($id_sewer);
        $data_sewer->delete();
        return redirect()->back();
    }

    public function index_akun($id_sewer){
        $data_akun = sewer::where('id_sewer',$id_sewer)->first();
        $data_harian = gaji:: where([
            ['id_sewer',$id_sewer],['jenis_gaji','Harian']
            ])->get()->take(4);
        $data_borongan = gaji:: where([
            ['id_sewer',$id_sewer],['jenis_gaji','Borongan']
            ])->get()->take(4);
        $total_gaji = gaji::where('id_sewer',$id_sewer)->select('tgl_gaji',gaji::raw('sum(gaji) as totalgaji'))->groupBy('id_sewer')
        ->groupBy('tgl_gaji')->get()->take(4);
        return view('Sewer.Akunprofil',compact('data_akun','data_harian','data_borongan','total_gaji'));
        
    }

    
}
