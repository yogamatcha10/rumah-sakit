<?php

namespace App\Http\Controllers;

use Dompdf\Dompdf;
use App\Models\Position;
use Illuminate\Http\Request;

class ReportPositionController extends Controller
{
    public function index()
    {
        $positions = Position::all();

        return view('positions/report', compact('positions'));
    }

    public function generate(Request $request)
    {
        $positions = Position::all();

        $pdf = new Dompdf();
        $pdf->loadHtml(view('positions/report', compact('positions')));
        $pdf->setPaper('A4', 'landscape');
        $pdf->render();

        return $pdf->stream('position_report.pdf');
    }
}
