<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Sop;

class DownloadController extends Controller
{
    public function download($id)
    {
        $sop = Sop::find($id);

        if (!$sop) {
            abort(404, 'SOP not found');
        }

        $filename = $sop->pdf;

        $file = public_path('app/public/pdfs' . $filename);

        if (file_exists($file)) {
            return response()->download($file, $filename);
        } else {
            abort(404, 'File not found');
        }
    }
}