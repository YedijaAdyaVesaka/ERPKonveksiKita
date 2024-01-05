<?php

namespace App\Http\Controllers;

use App\Models\ProdukModel;
use App\Models\VendorModel;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function tampilall()
    {
        $produks = ProdukModel::where('status', 1)->count();
        $bahans = ProdukModel::where('status', 2)->count();
        $vendor1 = VendorModel::where('status', 1)->count();
        $vendor2 = VendorModel::where('status', 2)->count();
        $vendor3 = VendorModel::where('status', 3)->count();
        $data = [
            'produks' => $produks, 
            'bahans' => $bahans, 
            'vendor1' => $vendor1,
            'vendor2' => $vendor2,
            'vendor3' => $vendor3
        ];
        // return view('dashboard')->with('data', $data);
        return view('layouts.dashboard',['data' =>$data]);
    }
}
