<?php

namespace App\Http\Controllers;

use App\Models\Handover;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

use Exception;

class HandoverController extends Controller
{
    public function index()
    {
        // Ambil data karyawan dari database
        $karyawans = Karyawan::all();

        // Kirim data karyawan ke view 'handover.index'
        return view('handover.index', ['karyawans' => $karyawans]);
    }

    public function save(Request $request): JsonResponse
    {
        // Validasi data formulir di sini jika diperlukan
        $request->validate([
            'tanggal_shift' => 'required|date',
            'example-textarea-input' => 'required|string|max:200',
            'status_pekerjaan' => 'required|in:Sudah Selesai,Belum Selesai',
            'signature' => 'required|string', // Menambahkan validasi untuk tanda tangan
        ]);

        try {
            DB::beginTransaction();

            // Tambahkan perulangan untuk menyimpan data setiap formulir
            foreach ($request->formDataArray as $formData) {
                // Tambahkan data ke model Handover
                Handover::create([
                    'tanggal' => $request->input('tanggal_shift'),
                    'petugas1' => $formData['petugas1'],
                    'petugas2' => $formData['petugas2'],
                    'pekerjaan' => $formData['pekerjaan'],
                    'status_pekerjaan' => $formData['status'],
                    'signature_path' => 'public/signatures/' . uniqid() . '.png', // Sesuaikan dengan penyimpanan signature
                ]);
            }

            DB::commit();

            return response()->json(['message' => 'Data Shift berhasil disimpan.']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Terjadi kesalahan saat menyimpan data. Error: ' . $e->getMessage()], 500);
        }
    }
}
