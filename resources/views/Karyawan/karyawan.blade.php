@extends('layouts.master')
@section('content')
    <div class="container-fluid mb-3">
        <a href="{{ route('inputKaryawan') }}" class="btn btn-primary">Tambah Karyawan</a>
    </div>
    <div class="card">
        <div class="card-body">
            <br>
            <table class="table table-bordered datatable">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama Karyawan</th>
                        <th scope="col">Jabatan</th>
                        <th scope="col">Departement</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($karyawans->count())
                        @foreach ($karyawans as $item)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->jobname }}</td>
                                <td>{{ $item->departname }}</td>
                                <td>
                                    <a href="{{ url('/karyawan/edit/tampil/' . $item->id) }}" class="btn btn-warning bi bi-pencil-square"
                                        role="button"></a>
                                    <form action="{{ url('/karyawan/delete/' . $item->id) }}" method="post">
                                        @method('delete')
                                        {{ csrf_field() }}
                                        <button type="submit" onclick="return confirm('Anda Menghapus Karyawan '+' {{ $item->position }} ?');"
                                            class="btn btn-danger delete-confirm my-1 bi bi-trash3-fill">
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>


@endsection
