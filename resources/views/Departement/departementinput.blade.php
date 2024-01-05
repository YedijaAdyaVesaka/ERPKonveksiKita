@extends('layouts.master')
@section('content')
    <div class="container-fluid">
        <form action="{{ route('ProsesInputDepartement') }}" method="post" name="input-form" id="input-form"
            enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Nama Depart</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" name="name"
                        placeholder="Masukan Nama Departement">
                </div>
            </div>
            <button class="btn btn-primary" type="submit" name="simpan">Tambah</button>
        </form>
    </div>
@endsection
