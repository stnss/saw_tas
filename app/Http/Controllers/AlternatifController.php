<?php

namespace App\Http\Controllers;

use App\Http\Requests\AlternatifRequest;
use App\Models\Alternatif;
use Illuminate\Http\Request;

class AlternatifController extends Controller
{
    /**
     * Function untuk menampilkan tampilan List Alternatif
     */
    public function index()
    {
        $alternatifs = Alternatif::all(); // Get seluruh data Alternatif
        return view('content.alternatif.index', compact('alternatifs'));
    }

    /**
     * Function untuk menampilkan tampilan Tambah Alternatif
     */
    public function create()
    {
        return view('content.alternatif.create');
    }

    /**
     * Function untuk menerima inputan dari tampilan Tambah Alternatif
     * @param AlternatifRequest $request | Untuk validasi input dari tampilan Tambah Alternatif
     */
    public function store(AlternatifRequest $request)
    {
        Alternatif::create($request->validated()); // Insert data Alternatif kedalam database

        return redirect()->route('alternatifs.index')->with('message', 'Successfully adding new Alternatif');
    }

    /**
     * Function untuk menampilkan tampilan Edit Alternatif
     */
    public function edit(Alternatif $alternatif)
    {
        return view('content.alternatif.edit', compact('alternatif'));
    }

    /**
     * Function untuk menerima inputan dari tampilan Ubah Alternatif
     * @param AlternatifRequest $request | Untuk validasi input dari tampilan Ubah Alternatif
     */
    public function update(AlternatifRequest $request, Alternatif $alternatif)
    {
        $alternatif->update($request->validated()); // Update data Alternatif
        return redirect()->route('alternatifs.index')->with('message', "Successfully update Alternatif");
    }

    /**
     * Function untuk menghapus kriteria terpilih
     */
    public function destroy(Alternatif $alternatif)
    {
        $alternatif->delete();
        return redirect()->route('alternatifs.index')->with('message', "Successfully delete Alternatif \"{$alternatif->name}\"");
    }
}
