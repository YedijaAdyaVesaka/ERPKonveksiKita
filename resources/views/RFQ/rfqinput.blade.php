@extends('layouts.master')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <h1 class="h3 mb-4 text-gray-800 col-md-12">Masukan RFQ</h1>
            <form action="{{ url('/rfq/data/input/proses') }}" method="post" name="input-form" id="input-form"
                enctype="multipart/form-data">
                {{ csrf_field() }}
                <div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Pilih Vendor</label>
                        <div class="col-sm-10">
                            <select class="form-select" name="id_vendor">
                                <option selected>-- Pilih Vendor --</option>
                                @if ($vendor->count())
                                    @foreach ($vendor as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama_vendor }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="form-group mt-3">
                        <button class="btn btn-primary" type="submit" name="simpan">Tambah</button>
                        <a href="{{ route('RfqTampil') }}" class="btn btn-danger">Batal</a>
                    </div>

                </div>
            </form>
        </div>


    </div>
@endsection
