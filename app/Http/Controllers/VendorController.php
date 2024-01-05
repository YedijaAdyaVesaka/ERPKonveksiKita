<?php

namespace App\Http\Controllers;

use App\Models\VendorModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\Events\Validated;

class VendorController extends Controller
{
    public function VendorTampil()
    {
        $vendor_tok = VendorModel::all();
        return view('Vendor_user/vendor',['vendors'=>$vendor_tok ]);
    }

    public function inputVendorTampil()
    {   
        $perusahaan = DB::table('t_vendor')->where('status', '=', '1')->get();
        return view('Vendor_user/vendorinput',['companys' => $perusahaan]);
    }

    public function inputVendor(Request $request)
    {
        $this->validate($request,[
            'nama_vendor' => 'required',
            'telpon' => 'required',
            'alamat' => 'required',
            'status' => 'required',
        ]);
        VendorModel::create([
            'nama_vendor' =>  $request->nama_vendor,
            'telpon' => $request->telpon,
            'alamat' => $request->alamat,
            'status' => $request->status,
            'company' => $request->company
        ]);
        return redirect(route('Vendor'));
    }

    public function editVendorTampil($id)
    {
        $vendors=VendorModel::find($id);
        $perusahaan = DB::table('t_vendor')->where('status', '=', '1')->get();
        return view('Vendor_user/vendoredit', ['vendors'=>$vendors],['companys' => $perusahaan]);
    }

    public function editVendor(Request $request,$id)
    {
        $this->validate($request,[
            'nama_vendor' => 'required',
            'telpon' => 'required',
            'alamat' => 'required',
            'status' => 'required',
        ]);
        $vendors=VendorModel::find($id);
        $vendors->nama_vendor = $request->nama_vendor;
        $vendors->alamat = $request->alamat;
        $vendors->telpon = $request->telpon;
        $vendors->status = $request->status;
        $vendors->company = $request->company;
        $vendors->save();

    return redirect(route('Vendor'));
    }

    public function deleteVendor($id)
    {
        $vendors=VendorModel::find($id);
        $vendors->delete();

        return redirect(route('Vendor'));
    }
}
