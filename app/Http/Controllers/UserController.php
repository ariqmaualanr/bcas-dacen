<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mockery\Matcher\Type;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{
    public function index()
    {
        $users = DB::table('users')
            ->orderBy('id', 'asc')
            ->get();
       
        $users = User::latest();
        if(request('search')){
            $users->where('name', 'like', '%' .request('search'). '%');
        }
        return view('user.index', [
            'users' => User::latest()->get(),
            'users' => $users->paginate(5)
        ]);
    }

    public function store(Request $request)
    {
        // Validasi input
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        // Simpan data ke tabel users
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password); // Enkripsi password
        $user->save();

        // Berikan pesan sukses
        session()->flash('success', 'User berhasil ditambahkan.');

        // Redirect ke halaman index user
        return redirect()->route('user.index');
    }

    public function edit($id)
    {
        // Logika untuk menampilkan halaman edit user
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:6',
        ]);

        // Temukan user berdasarkan ID
        $user = User::findOrFail($id);
        
        // Update data user
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password) {
            $user->password = bcrypt($request->password); // Enkripsi password baru
        }
        $user->save();

        // Berikan pesan sukses
        session()->flash('info', 'Data user berhasil diubah.');

        // Redirect ke halaman index user
        return redirect()->route('user.index');
    }

    public function destroy($id)
    {
        // Temukan user berdasarkan ID
        $user = User::findOrFail($id);

        // Hapus user
        $user->delete();

        // Berikan pesan sukses
        session()->flash('danger', 'User berhasil dihapus.');
        
        // Redirect ke halaman index user
        return redirect()->route('user.index');
    }
}
