<?php

namespace App\Http\Controllers;

use App\Http\Requests\SAWRequest;
use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Services\SAWServices;
use Illuminate\Support\Collection;

class SAWController extends Controller
{
    public function index()
    {
        $kriterias = Kriteria::all();
        $alternatifs = Alternatif::all();
        return view('content.saw.index', compact('kriterias', 'alternatifs'));
    }

    public function store(SAWRequest $request)
    {
        $data = (new SAWServices())->perhitungan($request->validated()['saw']);
        return view('content.saw.hasil', compact('data'));
    }
}
