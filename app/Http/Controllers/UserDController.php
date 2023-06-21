<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Position;
use App\Models\Departement;
use Illuminate\Http\Request;
use PDF;

class UserDController extends Controller
{
    public function index()
    {
        $title = 'Data User';
        $users = User::orderBy('id', 'asc')->get();

        // foreach ($users as $user) {
        //     echo 'Nama Pengguna: ' . $user->nama . PHP_EOL;

        //     if ($user->positions) {
        //         echo 'Posisi: ' . $user->positions->nama . PHP_EOL;
        //     } else {
        //         echo 'Posisi: Tidak ada posisi terkait.' . PHP_EOL;
        //     }

        //     if ($user->departments) {
        //         echo 'Departemen: ' . $user->departments->nama . PHP_EOL;
        //     } else {
        //         echo 'Departemen: Tidak ada departemen terkait.' . PHP_EOL;
        //     }

        //     echo '==========================' . PHP_EOL;
        // }

        return view('users.index', compact('users', 'title'));
    }

    public function create()
    {
        $title = 'Add Data User';
        $positions = Position::get();
        $departements = Departement::get();
        return view('users.create', compact('positions', 'departements', 'title'));
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'position' => 'required',
            'departement' => 'required',
        ]);

        User::create($validatedData);

        return redirect()
            ->route('users.index')
            ->with('success', 'User has been created successfully.');
    }
    public function edit($id)
    {
        $title = 'Edit Data User';
        $user = User::findOrFail($id);
        $positions = Position::get();
        $departements = Departement::get();
        // $users = User::with('position', 'departement')->get();
        return view('users.edit', compact('user', 'positions', 'departements', 'title'));
    }

    public function update(Request $request, User $User)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'position' => 'required',
            'departement' => 'required',
        ]);

        $User->fill($request->post())->save();

        return redirect()
            ->route('users.index')
            ->with('success', 'User Has Been updated successfully');
    }
    public function destroy(User $User)
    {
        $User->delete();
        return redirect()
            ->route('users.index')
            ->with('success', 'User has been deleted successfully');
    }
    // public function exportPdf()
    // {
    //     $title = 'Laporan Data User';
    //     $users = User::orderBy('id', 'asc')->get();
    //     $managers = User::where('position', 'manager')->get();
    //     return view(
    //         'users.pdf',
    //         compact('users', 'managers', 'title')
    //     );
    // }
    public function exportPdf()
    {
        set_time_limit(120);
        $title = 'Laporan Data User';
        $data = User::orderBy('id', 'asc')->get();
        $managers = User::where('position', 'manager')->get();
        $pdf = PDF::loadview('users.pdf', [
            'title' => $title,
            'data' => $data,
            'users' => $data,
            'managers' => $managers,
        ]);
        return $pdf->stream('laporan User');
    }
}