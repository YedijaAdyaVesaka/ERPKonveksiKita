<?php

namespace App\Http\Controllers;

use App\Models\RfqModel;
use App\Models\ProdukModel;
use App\Models\VendorModel;
use App\Models\RfqListModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RfqController extends Controller
{
    public function rfqTampil()
    {
        $rfq = RfqModel::join('t_vendor', 't_rfq.id_vendor', '=', 't_vendor.id')
            ->get(['t_rfq.*', 't_vendor.nama_vendor', 't_vendor.alamat']);
        return view('RFQ/rfq', ['rfqs' => $rfq]); 
    }

    public function inputRfqTampil()
    {
        $produk = ProdukModel::all();
        $vendor = VendorModel::Where('status',1)->orWhere('status', 2)->get();
        return view('RFQ/rfqinput',['produk' =>$produk,'vendor'=> $vendor]); 
    }

    public function InputRfq(Request $request)
    {   
        $this->validate($request, [
            'id_vendor' => 'required'
        ]);
        $tanggal = date("Y-m-d");
        RfqModel::create([
            'id_vendor'=> $request->id_vendor,
            'tanggal' => $tanggal,
            'status' => 0,
            'total_harga' => 0,
            'pembayaran' => 0
        ]);
        return redirect('/rfq/data');
    }

    public function rfqList($id_rfq)
    {
        // $datarfq = DB::table('t_rfq')
        // ->join('t_vendor','t_rfq.id_vendor','=','t_vendor.id_vendor')
        // ->where('t_rfq.id_vendor','=',$id_rfq)
        // ->first(['t_rfq.*','t_vendor.nama_vendor','t_vendor.alamat']);
        $datarfq = RfqModel::Where('id_rfq',$id_rfq)->join('t_vendor','t_rfq.id_vendor','t_vendor.id')->first(['t_rfq.*','t_vendor.nama_vendor','t_vendor.alamat']);
        // dd($datarfq);
        $List = RfqListModel::join('t_produk', 't_rfq_list.kode_produk', '=', 't_produk.id')
            ->where('t_rfq_list.id_rfq', $id_rfq)
            ->get(['t_rfq_list.*', 't_produk.nama_produk', 't_produk.harga']);
        $produk = ProdukModel::where('status','=',2)->get();
        return view('RFQ/rfqlist',['rfq'=>$datarfq,'produk'=>$produk,'List'=>$List]); 
    }

    public function ListProses(Request $request)
    {
        RfqListModel::create([
            'id_rfq' => $request->id_rfq,
            'kode_produk' => $request->kode_produk,
            'qty' => $request->qty,
            'satuan' => $request->satuan
        ]);
        $produk = ProdukModel::find($request->kode_produk);
        $harga = $produk->harga;
        $rfq = RfqModel::find($request->id_rfq);
        $harga_lama = $rfq->total_harga;
        $harga_baru = $harga_lama + ($harga * $request->qty);
        $rfq->total_harga = $harga_baru;
        $rfq->save();
        return redirect('/rfq/data/list/'.$request->id_rfq);
    }
    public function rfqSimpanBarang(Request $request,$id_rfq)
    {
        $rfq = RfqModel::find($id_rfq);;
        $rfq->status = $rfq->status + 1;
        $rfq->save();
        return redirect('/rfq/data/list/'. $request->id_rfq);
    }

    public function rfqPembayaran(Request $request,$id_rfq)
    {
        $rfq = RfqModel::find($id_rfq);
        $rfq->pembayaran = $request->payment;
        $rfq->status = $rfq->status + 1;
        $rfq->save();
        return redirect('/rfq/data/list/' . $request->id_rfq);
    }
    
    public function rfqConfirmPembayaran(Request $request,$id_rfq)
    {
        $rfqlist = RfqListModel::Where('id_rfq', $id_rfq)->get();
        foreach ($rfqlist as $item) {
            $product = ProdukModel::find($item->kode_produk);
            $product->qty = $product->qty + $item->qty;
            $product->save();
        }
        $rfq = RfqModel::find($id_rfq);
        $rfq->status = $rfq->status + 1;
        $rfq->save();
        return redirect(Route('RfqTampil'));
    }
    
    public function rfqDelete($id_rfq)
    {
        $rfq = RfqModel::find($id_rfq);
        $rfq->delete();
        return redirect(Route('RfqTampil'));
    }
}
