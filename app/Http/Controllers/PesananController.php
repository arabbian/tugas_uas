<?php

namespace App\Http\Controllers;
use App\Models\Pesanan;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Produk;

class PesananController extends Controller
{
    public function getpesanan(Request $req){
        $data_pesanan = Pesanan::
        join('produk','produk.id_produk','=','pesanan.id_produk')
        ->join('pelanggan','pelanggan.id_pelanggan','=','pesanan.id_pelanggan')
        ->orderBy('id_pesanan','desc')
        ->get();
        return Response()->json($data_pesanan);
    }
    public function getidpesanan($id){
        $data_pesanan = Pesanan::
        join('produk','produk.id_produk','=','pesanan.id_produk')
        ->join('pelanggan','pelanggan.id_pelanggan','=','pesanan.id_pelanggan')
        ->where ('id_pesanan','=',$id)
        ->get();
        return response()-> json($data_pesanan);
    }


    public function createpesanan (Request $req)
    {
        $validator = Validator::make($req->all(),[
            'tggl'=>'required',
            'id_pelanggan'=>'required',
            'id_produk'=>'required',
            'jumlah_psn'=>'required',

        ]);
        if($validator->fails()){
            return Response()->json($validator->errors()->toJson());
        }
        $produk = Produk::where('id_produk', $req->id_produk)->firstOrFail();
        $jumlah1 = $req->get('jumlah_psn');
        $qty = $produk->harga * $jumlah1;


        $save = pesanan::create([
            'tggl' =>date('Y-m-d H:i:s'),
            'id_pelanggan' =>$req->get('id_pelanggan'),
            'id_produk' =>$req->get('id_produk'),
            'jumlah_psn'=>$jumlah1,
            'qty' => $qty,
            'status' => 'Proses',
        ]);
        $produk =Produk::where('id_produk', $req->id_produk)->update([
            'jumlah'=>$produk->jumlah - $jumlah1

        ]);

        if($save){
            return Response()->json(['status'=>true,'message' => 'Sukses Menambah pesanan']);
        } else {
            return Response()->json(['status'=>false,'message' => 'Gagal Menambah pesanan']);
        }
    }
    public function updatepesanan(Request $req,$id){
        $validate = Validator::make($req->all(),[
            'tggl'=>'required',
            'id_pelanggan'=>'required',
            'id_produk'=>'required',
            'jumlah_psn'=>'required',

        ]);
        if($validate->fails()){
            return response()->json(($validate->errors()->toJson()));
        }
        $produk = Produk::where('id_produk', $req->id_produk)->firstOrFail();
        $jumlah = $req->get('jumlah_psn');
        $qty = $produk->harga * $jumlah;

        $update = pesanan::where('id_pesanan',$id)->update([
            'tggl'=>$req->get('tggl'),
            'id_pelanggan'=>$req->get('id_pelanggan'),
            'id_produk'=>$req->get('id_produk'),
            'jumlah_psn' => $jumlah,
            'qty' =>$qty


        ]);
        if($update){
            return response()->json(['status'=>true, 'message'=>'Sukses Merubah data pesanan.']);
        }else{
            return response()->json(['status'=>false,'message'=>'Gagal Merubah data pesanan']);
        }
    }
    public function deletepesanan($id){
        $delete = pesanan:: where('id_pesanan',$id)->delete();
        if($delete){
            return response()->json(['status'=>true, 'message'=>'Sukses Menghapus data pesanan.']);
        }else{
            return response()->json(['status'=>false,'message'=>'Gagal Menghapus data pesanan']);
        }
    }
    public function sudahdkr($id){

        $sudah = pesanan::where('id_pesanan',"=",$id)->update([
            'status'=>'Diterima'

        ]);
        if($sudah){
            return Response()->json(['status'=>true,'message' => 'Sukses Mengembalikan pesanan']);
        } else {
            return Response()->json(['status'=>false,'message' => 'Gagal Mengembalikan pesanan']);
        }
    }
}
