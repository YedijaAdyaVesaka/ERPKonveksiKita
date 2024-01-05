@extends('layouts.master')
@section('content')
    <div class="container-fluid mb-3">
        <a href="{{ route('inputVendor') }}" class="btn btn-primary">Masukan Vendor</a>
    </div>
    <div class="card">
        <div class="card-body">
            <br>
            <table class="table table-bordered datatable">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Telpon</th>
                        <th scope="col">Status</th>
                        <th scope="col">Company</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($vendors->count())
                        @foreach ($vendors as $item)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $item->nama_vendor }}</td>
                                <td>{{ $item->alamat }}</td>
                                <td>{{ $item->telpon }}</td>
                                <td>
                                    @if ($item->status == 1)
                                        Company
                                    @elseif($item->status == 2)
                                        Persero
                                    @endif
                                </td>
                                <td>
                                    @if (empty($item->company))
                                        No - Company
                                    @else
                                        {{ $item->company }}
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ url('/vendor_user/edit/tampil/' . $item->id) }}" class="btn btn-warning bi bi-pencil-square"
                                        role="button"></a>
                                    <form action="{{ url('/vendor/delete/' . $item->id) }}" method="post">
                                        @method('delete')
                                        {{ csrf_field() }}
                                        <button type="submit" onclick="return confirm('Anda Menghapus Vendor/User '+'?');"
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
