<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        return view('order.index');
    }
    public function order(Request $request)
    {
        $pesanan = explode(',',$request->pesanan);
        $status = $request->status;
        $jumlah_pesanan = count($pesanan);
        $total_pesanan = $jumlah_pesanan * 50000;
        $pesan = new Pembayaran;
        $bayar = $pesan->bayar($status,$total_pesanan);
        // dd($bayar);
        $data = [
            'nama' => $request->nama,
            'jumlah_pesanan' => $jumlah_pesanan,
            'total_pesanan' => $total_pesanan,
            'status' => $status,
            'diskon' => $pesan->diskon($status,$total_pesanan),
            'total_pembayaran' => $bayar
        ];
        return view('order.index',compact('data'));
    }
}


interface Pesan{
    public function diskon($status,$total_pesanan);
}

class Diskon implements Pesan{
    public function diskon($status,$total_pesanan)
    {
        if($status == 'member' && $total_pesanan >=100000){
            return $total_pesanan * (20/100);
        }elseif($status == 'member' && $total_pesanan < 100000){
            return $total_pesanan * (10/100);
        }else{
            return $total_pesanan * (0/100);
        }
    }
}
class Pembayaran extends Diskon{
    public function bayar($status,$total_pesanan)
    {
        return (int)$total_pesanan - (int)$this->diskon($status,$total_pesanan);
    }
}
