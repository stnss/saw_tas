<?php

namespace App\Http\Controllers;

use App\Http\Requests\SAWRequest;
use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Services\SAWServices;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

use PDF;

class SAWController extends Controller
{
    /**
     * Function untuk menampilkan halaman SAW
     */
    public function index()
    {
        $kriterias = Kriteria::all();
        $alternatifs = Alternatif::all();
        return view('content.saw.index', compact('kriterias', 'alternatifs'));
    }

    /**
     * Function untuk menerima input data yang ada pada halaman SAW
     */
    public function store(SAWRequest $request)
    {
        $data = (new SAWServices())->perhitungan($request->validated()['saw']); // Proses Perhitungan Metode SAW
        return view('content.saw.hasil', compact('data'));
    }

    /**
     * Function untuk mencetak hasil kedalam file .pdf
     */
    public function pdf(Request $request)
    {
        $data = $request->data;

        $pdf = PDF::loadView('content.saw.pdf', ['data' => $data]);

        return $pdf->stream('Hasil Ranking.pdf');
    }
}
