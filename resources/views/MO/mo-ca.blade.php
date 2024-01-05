@extends('layouts.master')
@section('content')
    <div class="container">
        <form action="product/bom-input-item" method="post" name="input-form" id="input-form">
            {{ csrf_field() }}
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Kode Bom</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="kode_bom" id="kode_bom" value="{{ $bom->kode_bom }}"
                        readonly>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Nama Produk</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nama_produk" value="{{ $bom->nama_produk }}" disabled>
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
                        @if ($list->count())
                            @foreach ($list as $item)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $item->kode_bom }}</td>
                                    <td>{{ $item->nama_produk }}</td>
                                    <td>{{ $item->qty * $mo->qty }}</td>
                                    <td>{{ $item->satuan }}</td>
                                    <td>{{ $item->harga }}</td>
                                    <td>{{ $item->l }}</td>
                                    <td>
                                        @if ($item->l < $item->qty * $mo->qty)
                                            <a href="{{ Route('RfqTampil') }}" class="btn btn-danger delete-confirm"
                                                role="">Bahan Kurang</a>
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
        <div class="container-sm ">
            <div class="row"></div>
            <!-- <div class="row mt-auto p-2 bd-highlight">
                          <label for="text_harga" class="font-weight-bold"> Total Harga : </label>
                          <label for="total_harga" id="val"> XXXXX</label>
                      </div> -->
        </div>
        @if ($avail == true && $mo->status == 3)
            <form action="{{ url('/mo/produksi/' . $mo->id) }}" method="post" class="btn p-0" name="input-form"
                id="input-form">
                {{ csrf_field() }}
                <button type="submit" onclick="return confirm('Proses Produce?');" class="btn btn-info">Produce</button>
            </form>
        @endif
        <a href="{{ route('tampilMO') }}" class="btn btn-danger">Batal</a>
    </div>
@endsection
