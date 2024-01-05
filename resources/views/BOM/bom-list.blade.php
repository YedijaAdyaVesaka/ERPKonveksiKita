@extends('layouts.master')
@section('content')
    <div class="container-fluid mt-4">
        <div class="container-fluid mb-3">
            <a href="/bom-input" class="btn btn-primary">Create BOM</a>
        </div>
        <div class="card">
            <div class="card-body">
                <br>
                <table class="table table-bordered datatable">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Kode Bom</th>
                            <th scope="col">Nama Produk</th>
                            <th scope="col">Harga Produksi</th>
                            <th scope="col">Tanggal Buat</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($boms->count())
                            @foreach ($boms as $item)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $item->kode_bom }}</td>
                                    <td>{{ $item->nama_produk }}</td>
                                    <td>{{ $item->total_harga }}</td>
                                    <td>{{ $item->tanggal }}</td>
                                    <td>
                                        <a href="{{ url('/bom/item_list/' . $item->id) }}"
                                            class="btn btn-warning bi bi-pencil-square" role="button"> </a>
                                        <a href="{{ url('/bom/delete/' . $item->id) }}"
                                            class="btn btn-danger delete-confirm bi bi-trash3-fill" role="button"> </a>
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
    </div>
@endsection
