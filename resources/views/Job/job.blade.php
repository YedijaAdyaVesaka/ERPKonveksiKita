@extends('layouts.master')
@section('content')
    <div class="container-fluid mb-3">
        <a href="{{ route('inputJob') }}" class="btn btn-primary">Tambah Position</a>
    </div>
    <div class="card">
        <div class="card-body">
            <br>
            <table class="table table-bordered datatable">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Posisi</th>
                        <th scope="col">Departement</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($jobs->count())
                        @foreach ($jobs as $item)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $item->position }}</td>
                                <td>{{ $item->name }}</td>
                                <td>
                                    <a href="{{ url('/job/edit/tampil/' . $item->id) }}" class="btn btn-warning bi bi-pencil-square"
                                        role="button"></a>
                                    <form action="{{ url('/job/delete/' . $item->id) }}" method="post">
                                        @method('delete')
                                        {{ csrf_field() }}
                                        <button type="submit" onclick="return confirm('Anda Menghapus Posisi '+' {{ $item->position }} ?');"
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
