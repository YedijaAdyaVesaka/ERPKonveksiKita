@extends('layouts.master')
@section('content')
    <div class="container-fluid">
        <form action="{{ url('/job/edit/upload/' . $jobs->id) }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Nama Posisi</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="position" placeholder="Masukan Nama Jabatan" value="{{ $jobs->position }}">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Pilih Departement</label>
                <div class="col-sm-10">
                    <div class="dropdown">
                        <select class="form-select" name="id_depart"> 
                            <option value="{{ $jobs->depart }}" selected>{{ $jobs->depart }}</option>
                            @foreach($departements as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <button class="btn btn-primary" type="submit" name="simpan">Update</button>
                <a href="{{ route('Departement') }}" class="btn btn-danger">Batal</a>
            </div>
        </form>
    </div>
@endsection
