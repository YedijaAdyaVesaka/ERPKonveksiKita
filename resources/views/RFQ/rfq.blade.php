@extends('layouts.master')
@section('content')
    <div class="container-fluid mb-3">
        <a href="{{ route('InputRfq') }}" class="btn btn-primary">Masukan RFQ</a>
    </div>
    <div class="card">
        <div class="card-body">
            <br>
            <table class="table table-bordered datatable">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama Vendor</th>
                        <th scope="col">Tanggal Transaksi</th>
                        <th scope="col">Total Harga</th>
                        <th scope="col">Pembayaran</th>
                        <th scope="col">Status</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($rfqs->count())
                        @foreach ($rfqs as $item)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $item->nama_vendor }}</td>
                                <td>{{ $item->tanggal }}</td>
                                <td>{{ $item->total_harga }}</td>
                                <td>
                                    @if ($item->pembayaran == 1)
                                        <span class="badge badge-primary" style="color: black">Cash</span>
                                    @elseif($item->pembayaran == 2)
                                        <span class="badge badge-primary" style="color: black">Transfer</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($item->status == 0)
                                        <span class="badge badge-secondary " style="color: black">Draft</span>
                                    @elseif($item->status == 1)
                                        <span class="badge badge-primary" style="color: black">Belum Dibayar</span>
                                    @elseif($item->status == 2)
                                        <span class="badge badge-warning" style="color: black">Menunggu Pembayaran</span>
                                    @elseif($item->status == 3)
                                        <span class="badge badge-secondary" style="color: black">Selesai</span>
                                    @endif
                                </td>
                                <td><a href="{{ url('/rfq/data/list/' . $item->id_rfq) }}"
                                        class="btn btn-warning bi bi-pencil-square" role="button"></a>
                                    <form action="{{ url('/rfq/delete/' . $item->id_rfq) }}" method="post">
                                        @method('delete')
                                        {{ csrf_field() }}
                                        <button type="submit"
                                            onclick="return confirm('Yakin hapus RFQ '+'{{ $item->nama_produk }}?');"
                                            class="btn btn-danger delete-confirm my-1 bi bi-trash3-fill">
                                        </button>
                                    </form>
                                    {{-- @if ($item->status == 3)
                                        <a href="#" class="btn btn-success bi bi-printer"></a>
                                    @elseif($item->status != 3)

                                    @endif --}}
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="7"> No record found </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
