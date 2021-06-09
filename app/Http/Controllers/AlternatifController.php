<?php

namespace App\Http\Controllers;

use App\Http\Requests\AlternatifRequest;
use App\Models\Alternatif;
use Illuminate\Http\Request;

class AlternatifController extends Controller
{
    public function index()
    {
        $alternatifs = Alternatif::all();
        return view('content.alternatif.index', compact('alternatifs'));
    }

    public function create()
    {
        return view('content.alternatif.create');
    }

    public function store(AlternatifRequest $request)
    {
        Alternatif::create($request->validated());

        return redirect()->route('alternatifs.index')->with('message', 'Successfully adding new Alternatif');
    }

    public function edit(Alternatif $alternatif)
    {
        return view('content.alternatif.edit', compact('alternatif'));
    }

    public function update(AlternatifRequest $request, Alternatif $alternatif)
    {
        $alternatif->update($request->validated());
        return redirect()->route('alternatifs.index')->with('message', "Successfully update Alternatif");
    }

    public function destroy(Alternatif $alternatif)
    {
        $alternatif->delete();
        return redirect()->route('alternatifs.index')->with('message', "Successfully delete Alternatif \"{$alternatif->name}\"");
    }
}
