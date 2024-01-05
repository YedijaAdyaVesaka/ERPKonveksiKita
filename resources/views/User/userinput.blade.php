@extends('layouts.master')
@section('content')
    <div class="container-fluid">
        <form action="{{ route('ProsesInputUser') }}" method="post" name="input-form" id="input-form"
            enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Nama user</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nama_vendor" name="nama_vendor"
                        placeholder="Masukan Nama User">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Telpon</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="telpon" name="telpon"
                        placeholder="Masukan Nomor Telepon">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Alamat</label>
                <div class="col-sm-10">
                    <textarea class="form-control" id="alamat" name="alamat" rows="3" placeholder="Masukan Alamat"></textarea>
                </div>
            </div>
            <input type="hidden" class="form-control" id="status" name="status" value="3">
            <button class="btn btn-primary" type="submit" name="simpan">Tambah</button>
            <a href="{{ route('User') }}" class="btn btn-danger">Batal</a>
        </form>
    </div>
@endsection
