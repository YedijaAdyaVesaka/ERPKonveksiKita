<?php

namespace App\Http\Controllers;

use App\Models\SQModel;
use App\Models\RfqModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Carbon\Carbon;

class AkunController extends Controller
{
    public function AkunTampil()
    {
        return view('Akun/Akun');
    }

    public function invoice()
    {
        $sq = SQModel::join('t_vendor', 't_vendor.id', '=', 't_sq.id_pelanggan')
            ->get(['t_sq.*', 't_vendor.nama_vendor', 't_vendor.status as l']);
        $tot = DB::table('t_sq')->sum('total_harga');
        return view('Akun/AkunSQ', ['sqs' => $sq, 'tots' => $tot]);
    }

    public function invoicePertanggal(Request $request)
    {
        $selectedDuration = $request->input('duration');

        if (!$selectedDuration || $selectedDuration === 'semua') {
            $sq = SQModel::join('t_vendor', 't_vendor.id', '=', 't_sq.id_pelanggan')
                ->get(['t_sq.*', 't_vendor.nama_vendor', 't_vendor.status as l']);

            $tot = DB::table('t_sq')->sum('total_harga');

            return view('Akun/AkunSQ', ['sqs' => $sq, 'tots' => $tot]);
        }

        $endDate = Carbon::now();
        $startDate = null;

        if ($selectedDuration === '1_minggu_terakhir') {
            $startDate = $endDate->copy()->subWeek();
        } elseif ($selectedDuration === '1_bulan_terakhir') {
            $startDate = $endDate->copy()->subMonth();
        }

        $sq = SQModel::join('t_vendor', 't_vendor.id', '=', 't_sq.id_pelanggan')
            ->whereBetween('t_sq.tanggal_transaksi', [$startDate, $endDate])
            ->get(['t_sq.*', 't_vendor.nama_vendor', 't_vendor.status as l']);

        $tot = DB::table('t_sq')
            ->whereBetween('t_sq.tanggal_transaksi', [$startDate, $endDate])
            ->sum('total_harga');

        return view('Akun/AkunSQ', ['sqs' => $sq, 'tots' => $tot]);
    }

    public function bill()
    {
        $rfq = RfqModel::join('t_vendor', 't_vendor.id', '=', 't_rfq.id_vendor')
            ->get(['t_rfq.*', 't_vendor.nama_vendor', 't_vendor.status as l']);
        $tot = DB::table('t_rfq')->sum('total_harga');
        return view('Akun/AkunRFQ', ['rfqs' => $rfq, 'tots' => $tot]);
    }

    public function billPertanggal(Request $request)
    {
        $selectedDuration = $request->input('duration');

        if (!$selectedDuration || $selectedDuration === 'semua') {
            $rfq = RfqModel::join('t_vendor', 't_vendor.id', '=', 't_rfq.id_vendor')
                ->get(['t_rfq.*', 't_vendor.nama_vendor', 't_vendor.status as l']);

            $tot = DB::table('t_rfq')->sum('total_harga');

            return view('Akun/AkunRFQ', ['rfqs' => $rfq, 'tots' => $tot]);
        }

        $endDate = Carbon::now();
        $startDate = null;

        if ($selectedDuration === '1_minggu_terakhir') {
            $startDate = $endDate->copy()->subWeek();
        } elseif ($selectedDuration === '1_bulan_terakhir') {
            $startDate = $endDate->copy()->subMonth();
        }

        $rfq = RfqModel::join('t_vendor', 't_vendor.id', '=', 't_rfq.id_vendor')
            ->whereBetween('t_rfq.tanggal', [$startDate, $endDate])
            ->get(['t_rfq.*', 't_vendor.nama_vendor', 't_vendor.status as l']);

        $tot = DB::table('t_rfq')
            ->whereBetween('t_rfq.tanggal', [$startDate, $endDate])
            ->sum('total_harga');

        return view('Akun/AkunRFQ', ['rfqs' => $rfq, 'tots' => $tot]);
    }
}
