<?php

namespace App\Http\Controllers;

use App\Models\sop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Mockery\Matcher\Type;
use App\Helpers\PdfHelper;
use File;

use Response;

use DB;

use App\Models\Product;

class SopController extends Controller
{

    // public function index()
    // {
    //     $sop = Sop::orderBy('created_at', 'desc');
    //     $sop = Sop::count();
    //     $query = Sop::latest(); // Urutkan data dari yang terbaru

    //     if (request('search')) {
    //         $query->where('nama', 'like', '%' . request('search') . '%');
    //     }
    public function index(Request $request)
    {
        $query = Sop::latest();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('nama', 'like', '%' . $search . '%')
                  ->orWhere('pdf', 'like', '%' . $search . '%');
        }

        $sop = $query->paginate(10); // Paginasi dengan 10 item per halaman

        return view('sop.index', compact('sop'));
        
    }

    public function create()
    {
        return view('sop.create');
    }

    public function store(Request $request)
{
    $this->validate($request, [
        'nama' => ['required', 'min:3'],
        'pdf' => ['file'],
    ]);

    $pdf = null;

    if ($request->hasFile('pdf')) {
        $file = $request->file('pdf');
        $fileName = $file->getClientOriginalName(); // Dapatkan nama asli file
        $fileName = PdfHelper::sanitizeFileName($file->getClientOriginalName()); // Gunakan helper untuk mengganti spasi dengan underscore

        // Simpan file PDF dengan nama asli ke direktori 'pdfs'
        $file->move('pdfs', $fileName);

        // Simpan nama berkas PDF asli ke dalam variabel $pdf
        $pdf = $fileName;
    }

    // Buat entitas SOP baru
    $sop = new Sop();
    $sop->nama = $request->nama;
    $sop->pdf = $pdf; // Simpan nama berkas PDF dalam database

    $sop->save();

    session()->flash('success', 'Data Berhasil Ditambahkan.');

    return redirect()->route('sop.index');
}


    public function edit($id)
{
    $sop = Sop::find($id);
    
    // Dapatkan nama asli berkas PDF dari basis data.
    $originalPdfName = basename($sop->pdf); 

    return view('sop.edit', [
        'sop' => $sop,
        'originalPdfName' => $originalPdfName, // Kirimkan nama asli berkas PDF ke tampilan.
    ]);
}

public function update(Request $request, $id)
{
    $this->validate($request, [
        'nama' => ['required', 'min:3'],
    ]);

    $sop = Sop::find($id);

    $pdf = $sop->pdf; // Simpan nama asli berkas PDF saat ini.

    if ($request->hasFile('pdf')) {
        if (Storage::exists($sop->pdf)) {
            Storage::delete($sop->pdf);
        }

        $uploadedPdf = $request->file('pdf');
        // $pdfPath = 'pdfs/' . $uploadedPdf->getClientOriginalName(); // Gunakan nama asli berkas sebagai jalur penyimpanan.
        $fileName = PdfHelper::sanitizeFileName($file->getClientOriginalName()); // Gunakan helper untuk mengganti spasi dengan underscore

        Storage::putFileAs('public', $uploadedPdf, $pdfPath); // Simpan berkas PDF tanpa enkripsi.

        $pdf = $uploadedPdf->getClientOriginalName(); // Simpan nama asli berkas PDF yang baru diunggah.
    }

    $sop->nama = $request->nama;
    $sop->pdf = $pdf; // Simpan nama berkas PDF dalam database.

    $sop->save();

    session()->flash('info', 'Data Berhasil Dirubah.');

    return redirect()->route('sop.index');
}


    public function destroy($id)
    {
        $sop = Sop::find($id);

        $sop->delete();

        session()->flash('danger', 'Data Berhasil Dihapus.');
        
        return redirect()->route('sop.index');
    }

    public function download($filename)
{
    // Ambil jalur berkas dari database berdasarkan nama berkas atau id.
    $sop = Sop::where('pdf', $filename)->firstOrFail();
    $filePath = public_path('pdfs/' . $filename); // Ubah sesuai dengan lokasi berkas di sistem Anda.
    // $filepath = public_path('images/filename.JPG');
    // return Response::download($filePath); 
    // Pastikan berkas PDF ada sebelum mengunduh.
    if (file_exists($filePath)) {
        return Response::download($filePath); 
        // return response()->file($filePath);
    } else {
        // Berikan tanggapan jika berkas tidak ditemukan.
        return response()->json(['error' => 'Berkas PDF tidak ditemukan.']);
    }
}
  

    
}
