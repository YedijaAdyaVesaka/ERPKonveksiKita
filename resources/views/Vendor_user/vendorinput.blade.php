@extends('layouts.master')
@section('content')
    <div class="container-fluid">
        <form action="{{ route('ProsesInputVendor') }}" method="post" name="input-form" id="input-form"
            enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Nama Vendor</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nama_vendor" name="nama_vendor"
                        placeholder="Masukan Nama Vendor / Perorangan">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Telpon</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="telpon" name="telpon"
                        placeholder="Masukan Nomor Telepon">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Alamat</label>
                <div class="col-sm-10">
                    <textarea class="form-control" id="alamat" name="alamat" rows="3" placeholder="Masukan Alamat"></textarea>
                </div>
            </div>
            <div class="d-flex my-4 w-25">
                <div class="input-group input-group-outline">
                    <input class="form-control-radio" type="radio" name="status" id="flexRadioDefault1" value="1"
                        checked>
                    <label class="form-check-label" for="flexRadioDefault1">
                        Company
                    </label>
                </div>
                <div class="input-group input-group-outline ">
                    <input class="form-control-radio" type="radio" name="status" value="2" id="flexRadioDefault2">
                    <label class="form-check-label" for="flexRadioDefault2">
                        Persero
                    </label>
                </div>
            </div>

            <div id="perseroDropdown" style="display: none;">
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Perusahaan</label>
                    <div class="col-sm-10">
                        <select class="form-select" name="company" id="vendorSelect">
                            <option selected value='No - Company'>-- Pilih Perusahaan</option>
                            @foreach ($companys as $comp)
                                <option value="{{ $comp->nama_vendor }}">{{ $comp->nama_vendor }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <button class="btn btn-primary" type="submit" name="simpan">Tambah</button>
            <a href="{{ route('Vendor') }}" class="btn btn-danger">Batal</a>
        </form>
    </div>
    <script>
        const radioCompany = document.getElementById('flexRadioDefault1');
        const radioPersero = document.getElementById('flexRadioDefault2');
        const perseroDropdown = document.getElementById('perseroDropdown');

        radioCompany.addEventListener('change', function() {
            if (radioCompany.checked) {
                perseroDropdown.style.display = 'none';
            }
        });

        radioPersero.addEventListener('change', function() {
            if (radioPersero.checked) {
                perseroDropdown.style.display = 'block';
            }
        });
    </script>
@endsection
