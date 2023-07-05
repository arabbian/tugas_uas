<?php

namespace App\Http\Controllers;
use App\Models\Pelanggan;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function getpelanggan()
    {
        $dt_pelanggan=pelanggan::get();
        return response()->json($dt_pelanggan);
    }

    public function getidpelanggan($id){
        $dt_pelanggan=pelanggan::where ('id_pelanggan','=',$id)->get();
        return response()-> json($dt_pelanggan);
    }


    public function tambahpelanggan(Request $req){
        $validate = Validator::make($req->all(),[
            'nama_pelanggan'=>'required',
            'alamat'=>'required',
            'no_hp'=>'required',

        ]);
        if($validate->fails()){
            return response()->json($validate->errors()->toJson());
        }
        $tambah = pelanggan::create([
            'nama_pelanggan'=>$req->nama_pelanggan,
            'alamat'=>$req->alamat,
            'no_hp'=>$req->no_hp,

        ]);
        if($tambah){
            return response()->json(['status'=>true, 'message'=>'Sukses menambah data pelanggan pelanggan.']);
        }else{
            return response()->json(['status'=>false,'message'=>'Gagal menabah data pelanggan pelanggan']);
        }
    }
    public function updatepelanggan(Request $req,$id){
        $validate = Validator::make($req->all(),[
            'nama_pelanggan'=>'required',
            'alamat'=>'required',
            'no_hp'=>'required',

        ]);
        if($validate->fails()){
            return response()->json(($validate->errors()->toJson()));
        }
        $update = pelanggan::where('id_pelanggan',$id)->update([
            'nama_pelanggan'=>$req->get('nama_pelanggan'),
            'alamat'=>$req->get('alamat'),
            'no_hp'=>$req->get('no_hp'),

        ]);
        if($update){
            return response()->json(['status'=>true, 'message'=>'Sukses Merubah data pelanggan.']);
        }else{
            return response()->json(['status'=>false,'message'=>'Gagal Merubah data pelanggan']);
        }
    }
    public function deletepelanggan($id){
        $delete = pelanggan:: where('id_pelanggan',$id)->delete();
        if($delete){
            return response()->json(['status'=>true, 'message'=>'Sukses Menghapus data pelanggan.']);
        }else{
            return response()->json(['status'=>false,'message'=>'Gagal Menghapus data pelanggan']);
        }
    }
}
