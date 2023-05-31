<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use App\Models\Obat;
use App\Models\User;
use Illuminate\Http\Request;
use PDF;

class PasienController extends Controller
{
    public function index()
    {
        $title = 'Data Pasien';
        $pasiens = Pasien::orderBy('id', 'asc')->get();
        $managers = User::where('position', '1')->get();
        return view(
            'Pasiens.index',
            compact('title', 'pasiens', 'managers')
        );
    }
    
    public function create()
    {
        $title = 'Add Data Pasien';
        $managers = User::where('position', '1')->get();
        return view('pasiens.create', compact('managers', 'title'));
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_pasien' => 'required',
            'jk' => 'nullable',
            'umur' => 'nullable',
            'sakit' => 'nullable',
            'alamat' => 'required',
        ]);

        Pasien::create($validatedData);

        return redirect()
            ->route('pasiens.index')
            ->with('success', 'Pasien has been created successfully.');
    }
    public function autocomplete(Request $request)
    {
        $data = Pasien::select("nama_pasien as value", "id")
                    ->where('nama_pasien', 'LIKE', '%'. $request->get('search'). '%')
                    ->get();
    
        return response()->json($data);
    }
    // public function edit($id)
    // {
    //     $title = 'Edit Data Pasien';
    //     $pasien = Pasien::findOrFail($id);
    //     $managers = User::where('position', 'manager')->get();
    //     return view(
    //         'Pasiens.edit',
    //         compact('pasien', 'managers', 'title')
    //     );
    // }

    // public function update(Request $request, Pasien $pasien)
    // {
    //     $request->validate([
    //         'name' => 'required',
    //         'location' => 'required',
    //     ]);

    //     $pasien->fill($request->post())->save();

    //     return redirect()
    //         ->route('pasiens.index')
    //         ->with('success', 'Pasien Has Been updated successfully');
    // }
    // public function destroy(Pasien $pasien)
    // {
    //     $pasien->delete();
    //     return redirect()
    //         ->route('p  asiens.index')
    //         ->with('success', 'Pasien has been deleted successfully');
    // }
    // // public function exportPdf()
    // // {
    // //     $title = 'Laporan Data Pasien';
    // //     $Pasiens = Pasien::orderBy('id', 'asc')->get();
    // //     $managers = User::where('position', 'manager')->get();
    // //     return view(
    // //         'Pasiens.pdf',
    // //         compact('Pasiens', 'managers', 'title')
    // //     );
    // // }
    // public function exportPdf()
    // {
    //     set_time_limit(120);
    //     $title = 'Laporan Data Pasien';
    //     $data = Pasien::orderBy('id', 'asc')->get();
    //     $managers = User::where('position', 'manager')->get();
    //     $pdf = PDF::loadview('Pasiens.pdf', [
    //         'title' => $title,
    //         'data' => $data,
    //         'Pasiens' => $data,
    //         'managers' => $managers
    //     ]);
    //     return $pdf->stream('laporan Pasien');
    // }
}
