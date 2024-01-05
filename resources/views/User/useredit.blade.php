@extends('layouts.master')
@section('content')
    <div class="container-fluid">
        <form action="{{ url('/user/edit/upload/' . $vendors->id) }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Nama User</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nama_vendor" name="nama_vendor"
                        value="{{ $vendors->nama_vendor }}">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Telpon</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="telpon" name="telpon" value="{{ $vendors->telpon }}">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Alamat</label>
                <div class="col-sm-10">
                    <textarea class="form-control" id="alamat" name="alamat" rows="3"value="{{ $vendors->alamat }}">{{ $vendors->alamat }}</textarea>
                </div>
            </div>
            <input type="hidden" class="form-control" id="status" name="status" value="3">
            <div class="form-group">
                <button class="btn btn-primary" type="submit" name="simpan">Update</button>
                <a href="{{ route('User') }}" class="btn btn-danger">Batal</a>
            </div>
        </form>
    </div>
@endsection
