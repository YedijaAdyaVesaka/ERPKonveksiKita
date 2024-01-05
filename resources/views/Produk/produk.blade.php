@extends('layouts.master')
@section('content')
    <div class="pagetitle">
        <h1>Produk</h1>

    </div>
    @if (session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <a href="/produkinput" class="btn btn-primary">
                    <i class="bi bi-plus me-1"></i>Tambah Data
                </a>
            </div>
        </div>

        @if ($produk->count())
            @foreach ($produk as $product)
                <div class="col-md-4">
                    <div class="card card-produk mb-3">
                        <img src="{{ url('gambar/' . $product->gambar) }}" alt="No images"
                            style="width:100%;height:200px; border-radius: 10%;">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->nama_produk }}</h5>
                            <p class="card-text">
                                <strong>ID Reference:</strong> {{ $product->id_reference }}<br>
                                <strong>Banyak:</strong> {{ $product->qty }}<br>
                                <strong>Harga Satuan:</strong> {{ $product->harga }}
                            </p>
                        </div>
                        <div class="card-footer d-flex justify-content-end gap-1">
                            <a href="{{ url('/produkedit/' . $product->id) }}" class="btn btn-warning btn-sm bi bi-pencil-square">
                            </a>
                            <form action="/produkdelete/{{ $product->id }}" method="post">
                                @method('delete')
                                {{ csrf_field() }}
                                <button type="submit"
                                    onclick="return confirm('Yakin hapus Produk {{ $product->nama_produk }}?');"
                                    class="btn btn-danger btn-sm delete-confirm bi bi-trash3-fill">
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="col-md-12">
                <div class="alert alert-info">
                    No record found
                </div>
            </div>
        @endif
    </div>
@endsection
