<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreKriteriaRequest;
use App\Http\Requests\UpdateKriteriaRequest;
use App\Models\Kriteria;
use Illuminate\Http\Request;

class KriteriaController extends Controller
{
    public function index()
    {
        $kriterias = Kriteria::all();
        return view('content.kriteria.index', compact('kriterias'));
    }

    public function create()
    {
        return view('content.kriteria.create');
    }

    public function store(StoreKriteriaRequest $request)
    {
        Kriteria::create($request->validated());

        return redirect()->route('kriterias.index')->with('message', 'Successfully adding new Kriteria');
    }

    public function edit(Kriteria $kriteria)
    {
        return view('content.kriteria.edit', compact('kriteria'));
    }

    public function update(UpdateKriteriaRequest $request, Kriteria $kriteria)
    {
        $kriteria->update($request->validated());
        return redirect()->route('kriterias.index')->with('message', "Successfully update Kriteria");
    }

    public function destroy(Kriteria $kriteria)
    {
        $kriteria->delete();
        return redirect()->route('kriterias.index')->with('message', "Successfully delete Kriteria \"{$kriteria->name}\"");
    }
}
