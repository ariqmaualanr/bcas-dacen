<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Mockery\Matcher\Type;
use Illuminate\Support\Facades\DB;

class KaryawanController extends Controller
{
    public function index(Request $request)
{
    $query = Karyawan::query();

    if ($request->has('search')) {
        $search = $request->input('search');
        $query->where('nama', 'like', '%' . $search . '%')
              ->orWhere('alamat', 'like', '%' . $search . '%');
    }
        
            $karyawans = $query->latest()->paginate(3); // Paginasi dengan 10 item per halaman
        
            return view('karyawan.index', compact('karyawans'));
    }

    public function create()
    {
        return view('karyawan.create');
    }

    public function store (Request $request)
    {
        $this->validate($request, [
            'nama' => ['required', 'min:3'],
            'alamat' => ['required', 'min:10'],
            'phone_number' => ['required', 'numeric'],
            'photo' => ['image'],
        ]);

        $photo = null;

        if ($request->hasFile('photo')){
            $photo = $request->file('photo')->store('photos');
        }

        $karyawan = new Karyawan();

        $karyawan->nama = $request->nama;
        $karyawan->alamat = $request->alamat;
        $karyawan->phone_number = $request->phone_number;
        $karyawan->photo = $photo;

        $karyawan->save();

        session()->flash('success', 'Data Berhasil Ditambahkan.');

        return redirect()->route('karyawan.index');
    }

    public function edit($id)
    {
        $karyawan = Karyawan::find($id);
        
        return view('karyawan.edit', [
            'karyawan' => $karyawan,
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama' => ['required', 'min:3'],
            'alamat' => ['required', 'min:10'],
            'phone_number' => ['required', 'numeric']
            
        ]);

        $karyawan = Karyawan::find($id);

        $photo = null;

        if ($request->hasFile('photo')){
            if (Storage::exists($karyawan->photo)) {
                Storage::delete($karyawan->photo);
            }
            $photo = $request->file('photo')->store('photos');
        }

        $karyawan->nama = $request->nama;
        $karyawan->alamat = $request->alamat;
        $karyawan->phone_number = $request->phone_number;
        $karyawan->photo = $photo;

        $karyawan->save();

        session()->flash('info', 'Data Berhasil Dirubah.');

        return redirect()->route('karyawan.index');
    }

    public function destroy($id)
    {
        $karyawan = Karyawan::find($id);

        $karyawan->delete();

        session()->flash('danger', 'Data Berhasil Dihapus.');
        
        return redirect()->route('karyawan.index');
    }
}
