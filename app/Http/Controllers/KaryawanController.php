<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;


class KaryawanController extends Controller
{
    public function index()
    {
        return view('karyawan.index', [
            'karyawans' => Karyawan::get(),
        ]);
    }

    public function create()
    {
        return view('karyawan.create');
    }

    public function store (Request $request)
    {
        $karyawan = new Karyawan();

        $karyawan->nama = $request->nama;
        $karyawan->alamat = $request->alamat;
        $karyawan->phone_number = $request->phone_number;

        $karyawan->save;
    }
}
