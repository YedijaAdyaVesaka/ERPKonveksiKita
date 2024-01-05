@extends('layouts.master')

@section('content')
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div>
    <section class="section dashboard">
        <div class="row">
            <div class="col-md-3">
                <div class="card info-card sales-card">
                    <div class="card-body">
                        <h5 class="card-title">Produk</h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-people"></i>
                            </div>
                            <div class="ps-3">
                                <h6>{{ $data['produks'] }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card info-card sales-card">
                    <div class="card-body">
                        <h5 class="card-title">Data Bahan</h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-people-fill"></i>
                            </div>
                            <div class="ps-3">
                                <h6>{{ $data['bahans'] }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card info-card revenue-card">
                    <div class="card-body">
                        <h5 class="card-title">Data Vendor Perusahaan</h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-building"></i>
                            </div>
                            <div class="ps-3">
                                <h6>{{ $data['vendor1'] }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card info-card revenue-card">
                    <div class="card-body">
                        <h5 class="card-title">Data Vendor Perorangan</h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-file-person-fill"></i>
                            </div>
                            <div class="ps-3">
                                <h6>{{ $data['vendor2'] }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card info-card revenue-card">
                    <div class="card-body">
                        <h5 class="card-title">Data Client</h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-person-vcard-fill"></i>
                            </div>
                            <div class="ps-3">
                                <h6>{{ $data['vendor3'] }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="col-md-3">
                <div class="card info-card customers-card">
                    <div class="card-body">
                        <h5 class="card-title">Data Baptis</h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-folder2-open"></i>
                            </div>
                            <div class="ps-3">
                                <h6>{{$baptis}}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </section>
@endsection
