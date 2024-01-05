<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DepartementModel;

class DepartementController extends Controller
{
    public function DepartementTampil()
    {
        $departements = DepartementModel::all();
        return view('Departement/departement',['departements'=>$departements ]);
    }

    public function inputDepartementTampil()
    {   
        return view('Departement/departementinput');
    }

    public function inputDepartement(Request $request)
    {
        $this->validate($request,[
            'name' => 'required'
        ]);
        DepartementModel::create([
            'name' =>  $request->name
        ]);
        return redirect(route('Departement'));
    }

    public function editDepartementTampil($id)
    {
        $departements=DepartementModel::find($id);
        return view('departement/departementedit',['departements' => $departements]);
    }

    public function editDepartement(Request $request,$id)
    {
        $this->validate($request,[
            'name' => 'required'
        ]);
        $departements=DepartementModel::find($id);
        $departements->name = $request->name;
        $departements->save();

    return redirect(route('Departement'));
    }

    public function deleteDepartement($id)
    {
        $departements=DepartementModel::find($id);
        $departements->delete();

        return redirect(route('Departement'));
    }
}
