<?php

namespace App\Http\Controllers;

use App\Models\BomModel;
use App\Models\ProdukModel;
use App\Models\BomListModel;
use Illuminate\Http\Request;

class BomController extends Controller
{
    public function tampilBom()
    {
        $bom = BomModel::join('t_produk', 't_bom.kode_produk', '=', 't_produk.id')
            ->get(['t_bom.*', 't_produk.nama_produk']);
        $produk = ProdukModel::where('status', 1)->get();
        return view('BOM/bom-list', ['boms' => $bom], ['produk' => $produk]);
    }

    public function uploadBOM(Request $request)
    {
        $tanggal = date("Y/m/d");
        $jumlah = BomModel::count();
        $kode_bom = 'BM' . str_pad($jumlah +1 , 3, '0', STR_PAD_LEFT);
        BomModel::create([
            'kode_bom' => $kode_bom,
            'kode_produk' => $request->kode_produk,
            'tanggal' => $tanggal,
            'total_harga' => 0
        ]);

        return redirect('/bom');
    }

    public function materialInput()
    {
        $produk = ProdukModel::where('status', 1)->get();
        return view('BOM/bom', ['produk' => $produk]);
    }

    public function materialInputItems($kode_bom)
    {
        $bom = BomModel::join('t_produk', 't_bom.kode_produk', '=', 't_produk.id')
            ->where('t_bom.id', $kode_bom)
            ->first(['t_bom.*', 't_produk.nama_produk', 't_produk.harga']);
        $bomList = BomListModel::join('t_produk', 't_bom_list.kode_produk', '=', 't_produk.id')
            ->where('t_bom_list.kode_bom', $kode_bom)
            ->get(['t_bom_list.*', 't_produk.nama_produk', 't_produk.harga']);
        $produk = ProdukModel::where('status', 2)->get();
        return view('BOM/bom-item', ['bom' => $bom, 'materials' => $produk, 'list' => $bomList]);
    }

    public function uploadList(Request $request)
    {
        BomListModel::create([
            'kode_bom_list' => $request->kode_bom_list,
            'kode_bom' => $request->id,
            'kode_produk' => $request->kode_produk,
            'qty' => $request->qty,
            'satuan' => $request->satuan
        ]);
        $product = ProdukModel::find($request->kode_produk);
        $harga = $product->harga;
        $bom = BomModel::find($request->id);
        $harga_lama = $bom->total_harga;
        $harga_baru = $harga_lama + ($harga * $request->qty);

        $bom->total_harga = $harga_baru;
        $bom->save();

        return redirect('/bom/item_list/' . $request->id);
    }

    public function deletbom($id)
    {
        $bom = BomModel::find($id);
        $bom->delete();
        return redirect('/bom');
    }

    public function deleteList($kode_bom_list)
    {
        $bom_list = BomListModel::find($kode_bom_list);
        $product = ProdukModel::find($bom_list->kode_produk);
        $bom = BomModel::find($bom_list->kode_bom);
        $harga = $product->harga;
        $harga_lama = $bom->total_harga;
        $harga_baru = $harga_lama - ($harga * $bom_list->qty);
        $bom->total_harga = $harga_baru;
        $bom->save();

        $bom_list->delete();
        return redirect('/bom/item_list/' . $bom_list->kode_bom);
    }
}
