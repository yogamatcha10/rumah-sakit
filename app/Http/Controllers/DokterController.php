<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Obat;
use App\Models\Dokter;
use App\Models\Detail;
use Illuminate\Http\Request;
use App\Charts\DokterLineChart;
use PDF;

class DokterController extends Controller
{
    public function index()
    {
        $title = 'Data Dokter';
        $dokters = Dokter::orderBy('id', 'asc')->get();
        return view('dokters.index', compact('title', 'dokters'));
    }

    public function create()
    {
        $title = 'Add Data Dokter';
        $managers = User::where('position', '1')->get();
        return view('dokters.create', compact('managers', 'title'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $validatedData = $request->validate([
            'no_resep' => 'required',
        ]);

        $dokter = [
            'no_resep' => $request->no_resep,
            'nama_dokter' => $request->nama_dokter,
            'tgl_praktik' => $request->tgl_praktik,
            'spesialis' => $request->spesialis,
            'total' => $request->total,
        ];
        $result = Dokter::create($dokter);


        if ($result) {
            for ($i = 1; $i <= $request->jml; $i++) {
                $details = [
                    'no_resep' => $request->no_resep,
                    'id_obat' => $request['id_obat' . $i],
                    'nama_obat' => $request['nama_obat' . $i],
                    'qty' => $request['qty' . $i],
                    'harga' => $request['harga' . $i],
                    'sub_total' => $request['sub_total' . $i],
                ];
                Detail::create($details);
            }
        }

        return redirect()->route('dokters.index')->with('success', 'Resep has been created successfully.');
    }

    public function show(Dokter $dokter)
    {
        return view('dokters.show', compact('Dokter'));
    }

    public function update(Request $request, Dokter $dokter)
    {
        $dokter->no_resep = $request->no_resep;
        $dokter->nama_dokter = $request->nama_dokter;
        $dokter->tgl_praktik = $request->tgl_praktik;
        $dokter->spesialis = $request->spesialis;
        $dokter->total = $request->total;

        if ($dokter->save()) {
            Detail::where('no_resep', $dokter->no_resep)->delete();

            for ($i = 1; $i <= $request->jml; $i++) {
                $details = [
                    'no_resep' => $request->no_resep,
                    'id_obat' => $request['id_obat' . $i],
                    'nama_obat' => $request['nama_obat' . $i],
                    'qty' => $request['qty' . $i],
                    'harga' => $request['harga' . $i],
                    'sub_total' => $request['sub_total' . $i],
                ];

                Detail::create($details);
            }

            // Lakukan tindakan setelah penyimpanan berhasil (jika ada)

            return redirect()->back()->with('success', 'Data dokter berhasil diperbarui.');
        } else {
            return redirect()->back()->with('error', 'Gagal memperbarui data dokter. Silakan coba lagi.');
        }
    }

    public function chartLine()
    {
        $api = route('dokters.chartLineAjax');

        $chart = new ResepLineChart;
        $chart->labels(['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'])->load($api);
        $title = "Beranda";
        return view('chart', compact('chart', 'title'));
    }

    public function chartLineAjax(Request $request)
    {
        $year = $request->has('year') ? $request->year : date('Y');
        $dokters = Dokter::select(\DB::raw("COUNT(*) as count"))
            ->whereYear('tgl_praktik', $year)
            ->groupBy(\DB::raw("Month(spesialis)"))
            ->pluck('count');

        $chart = new DokterLineChart;

        $chart->dataset('Dokter Chart', 'line', $dokters)->options([
            'fill' => 'true',
            'borderColor' => '#51C1C0',
        ]);

        return $chart->api();
    }
}
