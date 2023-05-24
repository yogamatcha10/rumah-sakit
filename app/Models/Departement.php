<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Dompdf;


class Departement extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'location', 'manager_id'];

    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }
    // public function report()
    // {
    //     $departements = App\Models\Departement::all();

    //     return view('/departements/report', compact('departements'));
    // }
    // public function generate()
    // {
    //     $departements = App\Models\Departement::all();

    //     $pdf = new Dompdf();
    //     $pdf->loadHtml(view('/departements/report', compact('departements')));
    //     $pdf->setPaper('A4', 'landscape');
    //     $pdf->render();

    //     return $pdf->stream('departement_report.pdf');
    // }
    public function user()
    {
        return $this->hasMany(User::class);
    }
}
