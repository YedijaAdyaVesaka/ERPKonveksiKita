@extends('layouts.master')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <h1 class="h3 mb-4 text-gray-800 col-md-12">Masukan Bill of Materials</h1>
            <form action="{{ url('/bom/bomMasuk') }}" method="post" name="input-form" id="input-form"
                enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Pilih Produk</label>
                    <div class="col-sm-10">
                        <select class="form-select" name="kode_produk">
                            <option selected>-- Pilih Product --</option>
                            @if ($produk->count())
                                @foreach ($produk as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama_produk }} -
                                        {{ $item->id_reference }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                <div class="form-group mt-4">
                    <button class="btn btn-primary" type="submit" name="simpan">Tambah</button>
                    <a href="{{ route('tampilBom') }}" class="btn btn-danger">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection
