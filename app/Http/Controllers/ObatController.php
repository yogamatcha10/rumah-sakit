<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use Illuminate\Http\Request;
use PDF;

class ObatController extends Controller
{
    public function index()
    {
        $title = 'Data Obat';
        $obats = Obat::orderBy('id', 'asc')->get();
        // $managers = User::where('position', '1')->get();
        return view('obats.index', compact('title', 'obats'));
    }

    public function create()
    {
        $title = 'Add Data Obat';
        $obat = Obat::findOrFail($id);
        // $managers = User::where('position', '1')->get();
        return view('obats.create', compact('title', 'obat'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_obat' => 'nullable',
            'jenis_obat' => 'nullable',
            'harga' => 'nullable',
        ]);

        Obat::create($validatedData);

        return redirect()->route('obats.index')->with('success', 'Obat has been created successfully.');
    }
    public function edit(Obat $obat)
    {
        $title = 'Edit Data Obat';
        return view('obats.edit', compact('obat', 'title'));
    }
    public function update(Request $request, obat $obat)
    {
        $request->validate([
            'nama_obat' => 'required',
            'jenis_obat' => 'required',
            'harga' => 'required',
        ]);

        $obat->fill($request->post())->save();

        return redirect()
            ->route('obats.index')
            ->with('success', 'Obat Has Been updated successfully');
    }

    public function autocomplete(Request $request)
    {
        $data = Obat::select("nama_obat as value", "id")
            ->where('nama_obat', 'LIKE', '%' . $request->get('search') . '%')
            ->get();

        return response()->json($data);
    }

    public function show(Obat $obat)
    {
        return response()->json($obat);
    }
}