@extends('layouts.master')
@section('content')
    <div class="container-fluid">
        <form action="{{ route('ProsesInputJob') }}" method="post" name="input-form" id="input-form"
            enctype="multipart/form-data">
            @csrf 
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Nama Posisi</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="position" placeholder="Masukan Nama Jabatan">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Pilih Departement</label>
                <div class="col-sm-10">
                    <div class="dropdown">
                        <select class="form-select" name="id_depart"> 
                            <option value="" selected>-- Pilih Departement --</option>
                            @foreach($departements as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <button class="btn btn-primary" type="submit" name="simpan" >Tambah</button>
        </form>
    </div>
@endsection
