@extends('layouts.master')
@section('content')
<div class="container-fluid mb-3">
    <a href="{{route('bill')}}" class="btn btn-primary">Akuntansi RFQ</a>
    <a href="{{route('invoice')}}" class="btn btn-primary">Akuntansi SQ</a>
</div>
    <table class="table table-bordered" id="myTable" name="myTable">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama Pengguna</th>
                <th scope="col">Tanggal Transaksi</th>
                <th scope="col">Total Harga</th>
                <th scope="col">Pembayaran</th>
                <th scope="col">Status</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
              
            <tr>
                <td colspan="7"> No record found </td>
            </tr>
           
        </tbody>
    </table>
@endsection