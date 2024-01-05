@extends('layouts.master')
@section('content')
    <div class="container">
        <form action="{{ url('product/sales-input-item') }}" method="post" name="input-form" id="input-form">
            {{ csrf_field() }}
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">ID SQ</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="id_sq" id="id_sq" value="{{ $sq->id_sq }}"
                        readonly>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Nama Customer</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nama_pelanggan" value="{{ $sq->nama_vendor }}" disabled>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Alamat</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="alamat" value="{{ $sq->alamat }}" disabled>
                </div>
            </div>
        </form>
    </div>
    <div class="container-fluid mt-4">
        <div class="card">
            <div class="card-body">
                <br>
                <table class="table table-bordered" id="myTable">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Kode</th>
                            <th scope="col">Nama Bahan</th>
                            <th scope="col">Banyak</th>
                            <th scope="col">Satuan</th>
                            <th scope="col">Harga Satuan</th>
                            <th scope="col">On Hand</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($sqList->count())
                            @foreach ($sqList as $item)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $item->kode_produk }}</td>
                                    <td>{{ $item->nama_produk }}</td>
                                    <td>{{ $item->qty }}</td>
                                    <td>{{ $item->satuan }}</td>
                                    <td>{{ $item->harga }}</td>
                                    <td>{{ $item->l }}</td>
                                    <td>
                                        @if ($item->l < $item->qty)
                                            <a href="{{ url('/mo') }}" class="btn btn-danger delete-confirm"
                                                style="color: black" role="">Produk Kurang</a>
                                        @else
                                            <span class="badge badge-success" style="color: black">Tersedia</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <br>
                @if ($avail == true && $sq->status == 1)
                    <form action="{{ url('/SQ/data/list/ca/' . $sq->id) }}" method="post" class="" name="input-form"
                        id="input-form">
                        {{ csrf_field() }}
                        <label>Pilih Pembayaran :</label>
                        <div class="d-flex my-4 w-25">
                            <div class="input-group input-group-outline">
                                <input class="form-control-radio" type="radio" name="metode_pembayaran"
                                    id="flexRadioDefault1" value="1" checked>
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Cash
                                </label>
                            </div>
                            <div class="input-group input-group-outline">
                                <input class="form-control-radio" type="radio" name="metode_pembayaran" value="2"
                                    id="flexRadioDefault2">
                                <label class="form-check-label" for="flexRadioDefault2">
                                    Transfer
                                </label>
                            </div>
                        </div>
                        <input type="text" id="kode_sales" value="{{ $sq->id }}" name="id_sq" hidden>
                        <button type="submit" onclick="return confirm('Anda Yakin?');" class="btn btn-info">Buat
                            Pesanan</button>
                    </form>
                @elseif($avail == true && $sq->status == 2)
                    <label>Metode Pembayaran :
                        {{ $sq->metode_pembayaran == 1 ? 'Cash' : 'Transfer' }}
                    </label><br>
                    <label>Total Tagihan : Rp.
                        {{ $sq->total_harga }}
                    </label><br>
                    <form action="{{ url('/SQ/data/list/bp/' . $sq->id) }}" method="post" class="" name="input-form"
                        id="input-form">
                        {{ csrf_field() }}
                        <input type="text" id="id_sq" value="{{ $sq->id }}" name="id_sq" hidden>
                        <button type="submit" onclick="return confirm('Finish Payment?');" class="btn btn-success">Finish
                            Payment</button>
                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection
