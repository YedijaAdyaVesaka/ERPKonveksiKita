@extends('layouts.master')
@section('content')
    <div class="container-fluid">
        <form action="{{ route('ProsesInputKaryawan') }}" method="post" name="input-form" id="input-form"
            enctype="multipart/form-data">
            @csrf
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Nama Karyawan</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="name" placeholder="Masukan Nama Karyawan">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Pilih Posisi</label>
                <div class="col-sm-10">
                    <div class="dropdown">
                        <select class="form-select" name="id_job">
                            <option selected>-- Pilih Posisi --</option>
                            @foreach ($jobs as $item)
                                <option value="{{ $item->id }}">{{ $item->position }} -- {{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <button class="btn btn-primary" type="submit" name="simpan">Tambah</button>
            <a href="{{ route('Karyawan') }}" class="btn btn-danger">Batal</a>
        </form>
    </div>
@endsection
