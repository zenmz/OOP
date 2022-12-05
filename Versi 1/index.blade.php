@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <form action="{{ route('order', []) }}" method="post" class="card">
                    @csrf
                    <div class="card-header">
                        Order
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="">Nama</label>
                            <input type="text" class="form-control" name="nama">
                        </div>
                        <div class="mb-3">
                            <label for="">Pesanan</label>
                            <input type="text" class="form-control" name="pesanan">
                            <small class="form-text">Gunakan tanda (,) untuk menambah beberapa menu</small>
                        </div>
                        <div class="mb-3">
                            <label for="">Status</label>
                            <select name="status" id="" class="form-control">
                                <option value="member">Member</option>
                                <option value="biasa">Biasa</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Detail Order</div>
                    <div class="card-body">
                        @isset($data)
                            <div class="mb-3">
                                <label for="">Nama</label>
                                <input type="text" class="form-control" value="{{$data['nama']}}" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="">Jumlah Pesanan</label>
                                <input type="number" class="form-control" value="{{$data['jumlah_pesanan']}}" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="">Total Pesanan</label>
                                <input type="number" class="form-control" value="{{$data['total_pesanan']}}" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="">Status</label>
                                <input type="text" class="form-control" value="{{$data['status']}}" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="">Diskon</label>
                                <input type="number" class="form-control" value="{{$data['diskon']}}" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="">Total Pembayaran</label>
                                <input type="number" class="form-control" value="{{$data['total_pembayaran']}}" readonly>
                            </div>
                        @endisset
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
