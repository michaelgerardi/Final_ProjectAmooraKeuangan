<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\sewer;
use App\Models\gaji;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use PDF;
use Auth;

class sewer_controller extends Controller
{
    public function index_sewer(){
        $data_sewer = sewer::all();
        return view('sewer.index',compact('data_sewer'));
    }

    public function tambah_sewer(Request $request){
        //\App\Models\sewer::create($request->all());
        $user = new User([
            'name'=>$request->nip,
            'role'=>'0',
            'password' => Hash::make($request->password),
        ]);
        $user->save();
        $id_user=User::where('name',$request->nip)->latest()->value('id');
      
        if($request->image != null){
            $fullname = $request->file('image')->getClientOriginalName();
            $extn =$request->file('image')->getClientOriginalExtension();
            $finalS=$id_user.'fotoprofil'.'_'.time().'.'.$extn;
            $path = $request->file('image')->storeAs('public/imgprofil', $finalS);
            $data_sewer = new sewer([
                'nip' =>$request->nip,
                'id_users'=>$id_user,
                'nama'=>$request->nama,
                'tgl_lahir'=>$request->tgl_lahir,
                'alamat'=>$request->alamat,
                'no_hp'=>$request->no_hp,
                'jenis_kelamin'=>$request->jenis_kelamin,
                'posisi'=>$request->posisi,
                'image'=>$finalS,
            ]);
        }
        $data_sewer->save();
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
        //return $data_sewer;
    }

    public function edit_sewer(Request $request){
        sewer::where('id_sewer',$request->id)->update([
            'nip'=> $request->nip,
            'nama'=> $request->nama,
            'tgl_lahir'=> $request->tgl_lahir,
            'alamat'=> $request->alamat,
            'no_hp'=> $request->no_hp,
            'jenis_kelamin'=> $request->jenis_kelamin,
            'posisi'=> $request->posisi,
        ]);
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

    public function edit_akun(Request $request){
        $id_sewer = Auth::user()->id;
        $del=sewer::where('id_sewer','=', $request->id)->value('image');
        $delpath='public/imgprofil/'.$del;
        Storage::delete($delpath);
        $fullname = $request->file('image')->getClientOriginalName();
        $extn =$request->file('image')->getClientOriginalExtension();
        $finalS=$id_sewer.'fotoprofil'.'_'.time().'.'.$extn;
        $path = $request->file('image')->storeAs('public/imgprofil', $finalS);
        sewer::where('id_sewer',$request->id)->update([
            'nama'=> $request->nama,
            'tgl_lahir'=> $request->tgl_lahir,
            'no_hp'=> $request->no_hp,
            'jenis_kelamin'=> $request->jenis_kelamin,
            'alamat'=> $request->alamat,
            'image'=>$finalS,
        ]);
        return redirect()->back();
    }
  
    public function download_sewer(){
        $data_sewer = sewer::all();
        $pdf = PDF::loadView('sewerpdf.sewerpdf',compact('data_sewer'));
        return $pdf->download('Laporan Gaji Sewer Amoora.pdf');
    }

    
}
