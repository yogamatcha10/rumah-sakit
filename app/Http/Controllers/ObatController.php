<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Obat;
use App\Models\Pasien;

class ObatController extends Controller
{
    public function autocomplete(Request $request)
    {
        $data = Pasien::select("nama_pasien as value", "id")
                    ->where('nama_pasien', 'LIKE', '%'. $request->get('search'). '%')
                    ->get();
    
        return response()->json($data);
    }
}
