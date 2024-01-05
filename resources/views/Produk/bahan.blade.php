@extends('layouts.master')
@section('content')
    <div class="pagetitle">
        <h1>Bahan</h1>
    </div>
    @if (session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div>
        <a href="/bahaninput" class="btn btn-primary active md-5 mb-3"><i class="bi bi-plus me-1"></i>Tambah Data</a>
    </div>
    <div class="card">
        <div class="card-body">
            <br>
            <table class="table table-bordered datatable">
                <thead class="table-secondary">
                    <tr>
                        <th>No</th>
                        <th>Gambar</th>
                        <th>Id Reference</th>
                        <th>Nama</th>
                        <th>Banyak</th>
                        <th>harga Satuan</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($bahan->count())
                        @foreach ($bahan as $bhn)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td><img src="{{ url('gambar/' . $bhn->gambar) }}" alt="No images"
                                        style="width:150px;height:150px; border-radius: 10%;"></td>
                                <td>{{ $bhn->id_reference }}</td>
                                <td>{{ $bhn->nama_produk }}</td>
                                <td>{{ $bhn->qty }}</td>
                                <td>{{ $bhn->harga }}</td>
                                <td><a href="{{ url('/bahanedit/' . $bhn->id) }}" class="btn btn-warning bi bi-pencil-square"
                                        role="button"></a>
                                    <form action="/bahandelete/{{ $bhn->id }}" method="post">
                                        @method('delete')
                                        {{ csrf_field() }}
                                        <button type="submit"
                                            onclick="return confirm('Yakin hapus Bahan '+'{{ $bhn->id }}?');"
                                            class="btn btn-danger delete-confirm my-1 bi bi-trash3-fill">
                                            {{-- <span class="text">Delete</span> --}}
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="7"> No record found </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
