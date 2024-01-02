<?php

namespace App\Http\Controllers;

use App\Models\Checklist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ChecklistController extends Controller
{
    public function index()
    {
        $checklists = Checklist::paginate(10);
        return view('checklist.index', compact('checklists'));
    }

    public function create()
    {
        return view('checklist.create');
    }

    public function createFolder()
    {
        return view('checklist.create-folder');
    }

    public function storeFolder(Request $request)
    {
        $request->validate([
            'nama' => 'required',
        ]);

        $folderName = $request->input('nama');
        $folderPath = "checklists/{$folderName}";

        // Membuat folder baru
        if (!Storage::disk('public')->exists($folderPath)) {
            Storage::disk('public')->makeDirectory($folderPath);
        }

        return redirect()->route('checklist.index')->with('success', 'Folder berhasil dibuat.');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'pdf' => 'required|mimes:pdf|max:2048',
        ]);

        $folderName = $request->input('nama');
        $folderPath = "checklists/{$folderName}";

        // Membuat folder baru
        if (!Storage::disk('public')->exists($folderPath)) {
            Storage::disk('public')->makeDirectory($folderPath);
        }

        // Mengunggah file PDF ke dalam folder
        $pdfPath = $request->file('pdf')->storeAs($folderPath, $request->file('pdf')->getClientOriginalName(), 'public');

        $checklist = Checklist::create([
            'nama' => $folderName,
            'pdf' => $pdfPath,
            'bulan' => now()->format('F'),
        ]);

        return redirect()->route('checklist.index')->with('success', 'Checklist berhasil disimpan.');
    }

    public function edit($id)
    {
        $checklist = Checklist::findOrFail($id);
        return view('checklist.edit', compact('checklist'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'pdf' => 'mimes:pdf|max:2048',
        ]);

        $checklist = Checklist::findOrFail($id);

        if ($request->hasFile('pdf')) {
            Storage::disk('public')->delete($checklist->pdf);

            $folderName = $request->input('nama');
            $folderPath = "checklists/{$folderName}";

            // Membuat folder baru
            if (!Storage::disk('public')->exists($folderPath)) {
                Storage::disk('public')->makeDirectory($folderPath);
            }

            // Mengunggah file PDF ke dalam folder
            $pdfPath = $request->file('pdf')->storeAs($folderPath, $request->file('pdf')->getClientOriginalName(), 'public');
            $checklist->pdf = $pdfPath;
        }

        $checklist->nama = $request->input('nama');
        $checklist->save();

        return redirect()->route('checklist.index')->with('success', 'Checklist berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $checklist = Checklist::findOrFail($id);
        Storage::disk('public')->deleteDirectory("checklists/{$checklist->nama}");
        $checklist->delete();

        return redirect()->route('checklist.index')->with('success', 'Checklist berhasil dihapus.');
    }
}
