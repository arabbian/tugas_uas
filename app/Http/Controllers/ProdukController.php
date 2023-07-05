<?php

namespace App\Http\Controllers;
use App\Models\Produk;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function getproduk()
    {
        $dt_produk=Produk::get();
        return response()->json($dt_produk);
    }

    public function getidproduk($id){
        $dt_produk=produk::where ('id_produk','=',$id)->get();
        return response()-> json($dt_produk);
    }

    
    public function tambahproduk(Request $req){
        $validate = Validator::make($req->all(),[
            'nama_produk'=>'required',
            'merek'=>'required',
            'harga'=>'required',
            'jumlah'=>'required'
        ]);
        if($validate->fails()){
            return response()->json($validate->errors()->toJson());
        }
        $tambah = produk::create([
            'nama_produk'=>$req->nama_produk,
            'merek'=>$req->merek,
            'harga'=>$req->harga,
            'jumlah'=>$req->jumlah
        ]);
        
        if($tambah){
            return response()->json(['status'=>true, 'message'=>'Sukses menambah data produk produk.']);
        }else{
            return response()->json(['status'=>false,'message'=>'Gagal menabah data produk produk']);
        }
    }
    public function updateproduk(Request $req,$id){
        $validate = Validator::make($req->all(),[
            'nama_produk'=>'required',
            'merek'=>'required',
            'harga'=>'required',
            'jumlah'=>'required'
        ]);
        if($validate->fails()){
            return response()->json(($validate->errors()->toJson()));
        }
        $update = produk::where('id_produk',$id)->update([
            'nama_produk'=>$req->get('nama_produk'),
            'merek'=>$req->get('merek'),
            'harga'=>$req->get('harga'),
            'jumlah'=>$req->get('jumlah'),
        ]);
        if($update){
            return response()->json(['status'=>true, 'message'=>'Sukses Merubah data produk.']);
        }else{
            return response()->json(['status'=>false,'message'=>'Gagal Merubah data produk']);
        }
    }
    public function deleteproduk($id){
        $delete = produk:: where('id_produk',$id)->delete();
        if($delete){
            return response()->json(['status'=>true, 'message'=>'Sukses Menghapus data produk.']);
        }else{
            return response()->json(['status'=>false,'message'=>'Gagal Menghapus data produk']);
        }
    }
}
