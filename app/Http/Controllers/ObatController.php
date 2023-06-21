<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use App\Models\User;
use App\Models\Dokter;
use App\Models\Detail;
use Illuminate\Http\Request;
use PDF;

class ObatController extends Controller
{
    // public function index()
    // {
    //     $title = 'Data Obat';
    //     $obats = Obat::orderBy('id', 'asc')->get();
    //     $managers = User::where('position', '1')->get();
    //     return view('obats.index', compact('title', 'obats', 'managers'));
    // }

    // public function create()
    // {
    //     $title = 'Add Data Obat';
    //     $managers = User::where('position', '1')->get();
    //     return view('obats.create', compact('title', 'managers'));
    // }

    // public function store(Request $request)
    // {
    //     $validatedData = $request->validate([
    //         'nama_obat' => 'nullable',
    //         'jenis_obat' => 'nullable',
    //     ]);

    //     Obat::create($validatedData);

    //     return redirect()->route('obats.index')->with('success', 'Obat has been created successfully.');
    // }

    public function autocomplete(Request $request)
    {
        $data = Obat::select("nama_obat as value", "id")
            ->where('nama_obat', 'LIKE', '%' . $request->get('search') . '%')
            ->get();

        return response()->json($data);
    }

    public function show(Obat $obats)
    {
        return response()->json($obats);
    }
}
