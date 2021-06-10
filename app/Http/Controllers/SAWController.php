<?php

namespace App\Http\Controllers;

use App\Http\Requests\SAWRequest;
use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Services\SAWServices;
use Illuminate\Support\Collection;

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
        // Proses Perhitungan Metode SAW
        $data = (new SAWServices())->perhitungan($request->validated()['saw']);
        return view('content.saw.hasil', compact('data'));
    }
}
