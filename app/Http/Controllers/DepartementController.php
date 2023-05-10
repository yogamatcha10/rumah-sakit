<?php

namespace App\Http\Controllers;

use App\Models\Departement;
use App\Models\User;
use Illuminate\Http\Request;

class DepartementController extends Controller
{
    public function index()
    {
        $title = 'Data Departement';
        $departements = Departement::orderBy('id', 'asc')->get();
        $managers = User::where('position', 'manager')->get();
        return view(
            'departements.index',
            compact('departements', 'managers', 'title')
        );
    }
    public function create()
    {
        $title = 'Add Data Departement';
        $managers = User::where('position', 'manager')->get();
        return view('departements.create', compact('managers', 'title'));
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'location' => 'nullable',
            'manager_id' => 'required',
        ]);

        Departement::create($validatedData);

        return redirect()
            ->route('departements.index')
            ->with('success', 'Departement has been created successfully.');
    }
    public function edit($id)
    {
        $title = 'Edit Data Departement';
        $departement = Departement::findOrFail($id);
        $managers = User::where('position', 'manager')->get();
        return view(
            'departements.edit',
            compact('departement', 'managers', 'title')
        );
    }

    public function update(Request $request, Departement $departement)
    {
        $request->validate([
            'name' => 'required',
            'location' => 'required',
        ]);

        $departement->fill($request->post())->save();

        return redirect()
            ->route('departements.index')
            ->with('success', 'Departement Has Been updated successfully');
    }
    public function destroy(Departement $departement)
    {
        $departement->delete();
        return redirect()
            ->route('departements.index')
            ->with('success', 'Departement has been deleted successfully');
    }
    public function exportPdf()
    {
        $title = 'Laporan Data Departement';
        $departements = Departement::orderBy('id', 'asc')->get();
        $managers = User::where('position', 'manager')->get();
        return view(
            'departements.pdf',
            compact('departements', 'managers', 'title')
        );
    }
}
