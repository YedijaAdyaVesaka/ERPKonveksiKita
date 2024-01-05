<?php

namespace App\Http\Controllers;

use App\Models\JobModel;
use Illuminate\Http\Request;
use App\Models\KaryawanModel;

class KaryawanController extends Controller
{
    public function KaryawanTampil()
    {
        $karyawans = KaryawanModel::join('t_jobpos', 't_karyawan.id_job', '=', 't_jobpos.id')
            ->join('t_departement', 't_jobpos.id_depart', '=', 't_departement.id')
            ->get(['t_karyawan.*', 't_jobpos.position as jobname', 't_departement.name as departname']);
        return view('Karyawan/karyawan', ['karyawans' => $karyawans]);
    }

    public function inputKaryawanTampil()
    {
        $jobs = JobModel::join('t_departement', 't_jobpos.id_depart', '=', 't_departement.id')
            ->get(['t_jobpos.*', 't_departement.name']);
        return view('Karyawan/karyawaninput', ['jobs' => $jobs]);
    }

    public function inputKaryawan(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'id_job' => 'required'
        ]);

        KaryawanModel::create([
            'name' => $request->name,
            'id_job' => $request->id_job
        ]);

        return redirect(route('Karyawan'));
    }

    public function editKaryawanTampil($id)
    {
        $karyawans = KaryawanModel::find($id);
        $karyatampil = KaryawanModel::join('t_jobpos', 't_karyawan.id_job', '=', 't_jobpos.id')
            ->join('t_departement', 't_departement.id', '=', 't_jobpos.id_depart')
            ->where('t_karyawan.id', $id) 
            ->select('t_karyawan.name', 't_jobpos.position', 't_departement.name as namedepart')
            ->first();
        $jobs = JobModel::join('t_departement', 't_jobpos.id_depart', '=', 't_departement.id')
            ->get(['t_jobpos.*', 't_departement.name']);
        return view('Karyawan/karyawanedit', ['karyawans' => $karyawans, 'jobs' => $jobs, 'karyatampil' => $karyatampil]);
    }

    public function editKaryawan(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'id_job' => 'required'
        ]);

        $karyawans = KaryawanModel::find($id);
        $karyawans->name = $request->name;
        $karyawans->id_job = $request->id_job;
        $karyawans->save();

        return redirect(route('Karyawan'));
    }

    public function deleteKaryawan($id)
    {
        $karyawans = KaryawanModel::find($id);
        $karyawans->delete();

        return redirect(route('Karyawan'));
    }
}
