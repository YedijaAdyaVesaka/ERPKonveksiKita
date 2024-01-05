@extends('layouts.master')
@section('content')
    <div class="container-fluid">
        <form action="{{ url('/karyawan/edit/upload/' . $karyawans->id) }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Nama Karyawan</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="name" placeholder="Masukan Nama Jabatan" value="{{ $karyawans->name }}">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Pilih Posisi</label>
                <div class="col-sm-10">
                    <div class="dropdown">
                        <select class="form-select" name="id_job"> 
                            <option value="{{ $karyawans->id_job }}" selected>{{ $karyatampil->position }} -- {{ $karyatampil->namedepart }}</option>
                            @foreach($jobs as $item)
                                <option value="{{ $item->id }}">{{ $item->position }} -- {{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <button class="btn btn-primary" type="submit" name="simpan">Update</button>
                <a href="{{ route('Karyawan') }}" class="btn btn-danger">Batal</a>
            </div>
        </form>
    </div>
@endsection
