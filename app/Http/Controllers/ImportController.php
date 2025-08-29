<?php

namespace App\Http\Controllers;

use PhpOffice\PhpWord\TemplateProcessor;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use App\Models\Cuti;
use App\Models\Pyb;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Dompdf\Dompdf;
use PhpOffice\PhpWord\IOFactory;
use App\Import\DataImport;
use Maatwebsite\Excel\Facades\Excel;


class ImportController extends Controller
{
    public function importcuti()
    {
        return view('admin.import.index', ([
            'title' => 'Import Cuti',         
        ]));
    }

    public function import(Request $request)
    {
        // return Carbon::now()->format('Y-m-d H:i:s');
       $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        Excel::import(new DataImport, $request->file('file')->store('temp'));

        return back()->with('success', 'Data berhasil diimpor!');
    }

}
