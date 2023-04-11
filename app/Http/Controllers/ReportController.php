<?php

namespace App\Http\Controllers;

use App\Models\Departement;
use Dompdf\Dompdf;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        $departements = Departement::all();

        return view('report', compact('departements'));
    }

    public function generate(Request $request)
    {
        $departements = Departement::all();

        $pdf = new Dompdf();
        $pdf->loadHtml(view('report', compact('departements')));
        $pdf->setPaper('A4', 'landscape');
        $pdf->render();

        return $pdf->stream('departement_report.pdf');
    }
}
