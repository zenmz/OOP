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
        $jumlah_pesanan = 0;
        if($request->pesanan != null){
            $pesanan = $request->pesanan;
            $jumlah_pesanan = count($pesanan);
        }
        $status = $request->status;
        $total_pesanan = $jumlah_pesanan * 50000;
        $pesan = new Pembayaran($status,$total_pesanan);
        $bayar = $pesan->bayar();
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
    public function diskon();
}

class Diskon implements Pesan{
    public $status;
    public $total_pesanan;
    public function __construct($status,$total_pesanan)
    {
        $this->status = $status;
        $this->total_pesanan = $total_pesanan;
    }
    public function diskon()
    {
        if($this->status == 'member' && $this->total_pesanan >=100000){
            return $this->total_pesanan * (20/100);
        }elseif($this->status == 'member' && $this->total_pesanan < 100000){
            return $this->total_pesanan * (10/100);
        }else{
            return $this->total_pesanan * (0/100);
        }
    }
}
class Pembayaran extends Diskon{
    public function bayar()
    {
        return (int)$this->total_pesanan - (int)$this->diskon($this->status,$this->total_pesanan);
    }
}
