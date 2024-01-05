<?php

namespace App\Http\Controllers;

use App\Models\VendorModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function UserTampil()
    {
        $vendor_tok = DB::table('t_vendor')->where('status', '=', '3')->get();
        return view('user/user',['vendors'=>$vendor_tok ]);
    }

    public function inputUserTampil()
    {   
        $perusahaan = DB::table('t_vendor')->where('status', '=', '3')->get();
        return view('user/userinput',['companys' => $perusahaan]);
    }

    public function inputUser(Request $request)
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
        return redirect(route('User'));
    }

    public function editUserTampil($id)
    {
        $vendors=VendorModel::find($id);
        return view('user/useredit', ['vendors'=>$vendors]);
    }

    public function editUser(Request $request,$id)
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

    return redirect(route('User'));
    }

    public function deleteUser($id)
    {
        $vendors=VendorModel::find($id);
        $vendors->delete();

        return redirect(route('User'));
    }
}
