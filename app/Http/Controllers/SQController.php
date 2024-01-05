<?php

namespace App\Http\Controllers;

use App\Models\SQModel;
use App\Models\ProdukModel;
use App\Models\SQListModel;
use App\Models\VendorModel;
use Illuminate\Http\Request;

class SQController extends Controller
{
    public function tampilSQ()
    {
        $SQ = SQModel::join('t_vendor', 't_sq.id_pelanggan', '=', 't_vendor.id')
            ->get(['t_sq.*', 't_vendor.nama_vendor', 't_vendor.alamat']);
        return view('SQ/sq', ['sq' => $SQ]);
    }

    public function tampilSQmasuk()
    {
        $user = VendorModel::Where('status', 3)->get();
        // dd($user);
        return view('SQ/sqinput', ['users' => $user]);
    }

    public function SQProses(Request $request)
    {
        $tanggal = date('Y-m-d');
        $jumlah = SQModel::count();
        $id_sq = 'SQ' . str_pad($jumlah + 1, 3, '0', STR_PAD_LEFT);
        SQModel::create([
            'id_sq' => $id_sq,
            'id_pelanggan' => $request->id_pelanggan,
            'tanggal_transaksi' => $tanggal,
            'status' => 0,
            'total_harga' => 0,
            'metode_pembayaran' => 0
        ]);
        return redirect('/SQ/data');
    }

    public function SQList($id_sq)
    {
        $sq = SQModel::join('t_vendor', 't_sq.id_pelanggan', '=', 't_vendor.id')
            ->where('t_sq.id', $id_sq)
            ->first(['t_sq.*', 't_vendor.nama_vendor', 't_vendor.alamat']);
        $sqList = SQListModel::join('t_produk', 't_sq_list.kode_produk', '=', 't_produk.id')
            ->where('t_sq_list.id_sq', $id_sq)
            ->get(['t_sq_list.*', 't_produk.nama_produk', 't_produk.harga']);
        $produk = ProdukModel::where('status', 1)->get();

        return view('SQ/sqlist', ['sq' => $sq, 'sqlist' => $sqList, 'produk' => $produk]);
    }

    public function sqUploadItems(Request $request)
    {
        $check = SQListModel::where('kode_produk', $request->kode_produk)
            ->where('id_sq', $request->id_sq)
            ->first();
        if ($check != null) {
            $list = SQListModel::find($check->id_sq_list);
            $jumlah_baru = $list->qty + $request->qty;
            $list->qty = $jumlah_baru;
            $list->save();
        } else {
            SQListModel::create([
                'id_sq' => $request->id_sq,
                'kode_produk' => $request->kode_produk,
                'qty' => $request->qty,
                'satuan' => $request->satuan
            ]);
        }
        return $this->calcPrice($request->id_sq);
    }

    public function calcPrice($id_sq)
    {
        $total_harga = 0;
        $lists = SQListModel::where('id_sq', $id_sq)->get();
        foreach ($lists as $i) {
            $product = ProdukModel::find($i->kode_produk);
            $harga = $product->harga;
            $total_harga = $total_harga + ($harga * $i->qty);

            $i->total = $harga * $i->qty;
            $i->save();
        }
        $sq = SQModel::find($id_sq);
        $sq->total_harga = $total_harga;
        $sq->save();

        return redirect('/SQ/data/input/list/' . $id_sq);
    }

    public function saveItems($id_sq)
    {
        $sq = SQModel::find($id_sq);
        $sq->status = $sq->status + 1;
        $sq->save();
        return redirect('/SQ/data/input/list/' . $id_sq);
    }

    public function caItems($id_sq)
    {
        $sq = SqModel::join('t_vendor', 't_sq.id_pelanggan', '=', 't_vendor.id')
            ->where('t_sq.id', $id_sq)
            ->first(['t_sq.*', 't_vendor.nama_vendor', 't_vendor.alamat']);
        $id_sq = $sq->id;
        $sqList = SQListModel::join('t_produk', 't_sq_list.kode_produk', '=', 't_produk.id')
            ->where('t_sq_list.id_sq', $id_sq)
            ->get(['t_sq_list.*', 't_produk.nama_produk', 't_produk.harga', 't_produk.qty as l']);
        $produk = ProdukModel::where('status', 1)->get();
        $avail = $this->getAvailability($sqList, $sq);
        return view('SQ.sq-ca', ['sq' => $sq, 'materials' => $produk, 'sqList' => $sqList, 'avail' => $avail]);
    }

    public function salesCreateBill(Request $request)
    {
        $sq = SQModel::find($request->id_sq);
        $sq->metode_pembayaran = $request->metode_pembayaran;
        $sq->status = $sq->status + 1;
        $sq->save();
        return $this->caItems($request->id_sq);
    }

    public function getAvailability($sqList, $sq)
    {
        $avail = true;
        foreach ($sqList as $item) {
            if ($item->kuantitas < ($item->quantity)) {
                $avail = false;
            } else {
                $avail = true;
            }
        }
        return $avail;
    }

    public function confirmBill(Request $request)
    {

        $sqList = SQListModel::Where('id_sq', $request->id_sq)->get();
        foreach ($sqList as $item) {
            $product = ProdukModel::find($item->kode_produk);
            $product->qty = $product->qty - $item->qty;
            $product->save();
        }
        $sq = SQModel::find($request->id_sq);
        $sq->metode_pembayaran = $sq->metode_pembayaran;
        $sq->status = $sq->status + 1;
        $sq->save();
        return redirect('/SQ/data');
    }

    public function hapusSQ($id_sq)
    {
        SQModel::find($id_sq)->delete();
        SQListModel::where('id_sq', $id_sq)->delete();
        return redirect('/SQ/data');
    }

    public function hapusSQList($id_sq_list)
    {
        $sq_list = SQListModel::find($id_sq_list);
        $id_sq = $sq_list->id_sq;
        $deleted_price = $sq_list->total; 
        $sq_list->delete();

        $sq = SQModel::find($id_sq);
        $sq->total_harga -= $deleted_price;
        $sq->save();

        return redirect('/SQ/data/input/list/' . $id_sq);
    }
}
