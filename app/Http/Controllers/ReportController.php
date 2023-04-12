<?php

namespace App\Http\Controllers;

use Dompdf\Dompdf;
use App\Models\Departement;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function report()
    {
        $departements = Departement::all();

        return view('/departements/report', compact('departements'));
    }

    public function generate(Request $request)
    {
        $departements = Departement::all();

        $pdf = new Dompdf();
        $pdf->loadHtml(view('departements.report', compact('departements')));
        $pdf->setPaper('A4', 'landscape');
        $pdf->render();

        return $pdf->stream('departement_report.pdf');
    }
}
