<?php

namespace App\Http\Controllers;

use App\Models\JobModel;
use Illuminate\Http\Request;
use App\Models\DepartementModel;
use Illuminate\Support\Facades\DB;

class JobController extends Controller
{
    public function JobTampil()
    {
        $jobs = JobModel::join('t_departement', 't_jobpos.id_depart', '=', 't_departement.id')
            ->get(['t_jobpos.*', 't_departement.name']);
        return view('Job/job', ['jobs' => $jobs]);
    }

    public function inputJobTampil()
    {
        $departements = DepartementModel::all();
        return view('Job/jobinput', ['departements' => $departements]);
    }

    public function inputJob(Request $request)
    {
        $this->validate($request, [
            'position' => 'required',
            'depart' => 'required'
        ]);

        JobModel::create([
            'position' => $request->position,
            'depart' => $request->depart
        ]);

        return redirect(route('Job'));
    }

    public function editJobTampil($id)
    {
        $jobs = JobModel::find($id);
        $departements = DepartementModel::all();
        return view('Job/jobedit', ['jobs' => $jobs, 'departements' => $departements]);
    }

    public function editJob(Request $request, $id)
    {
        $this->validate($request, [
            'position' => 'required',
            'depart' => 'required'
        ]);
        $jobs = JobModel::find($id);
        $jobs->position = $request->position;
        $jobs->depart = $request->depart;
        $jobs->save();

        return redirect(route('Job'));
    }

    public function deleteJob($id)
    {
        $jobs = JobModel::find($id);
        $jobs->delete();

        return redirect(route('Job'));
    }
}
