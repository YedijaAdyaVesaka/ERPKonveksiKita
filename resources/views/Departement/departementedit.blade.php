@extends('layouts.master')
@section('content')
    <div class="container-fluid">
        <form action="{{ url('/departement/edit/upload/' . $departements->id) }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Nama Depart</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" name="name"
                        value="{{ $departements->name }}">
                </div>
            </div>     
            <div class="form-group">
                <button class="btn btn-primary" type="submit" name="simpan">Update</button>
                <a href="{{ route('Departement') }}" class="btn btn-danger">Batal</a>
            </div>
        </form>
    </div>
@endsection
