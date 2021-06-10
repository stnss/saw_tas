<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreKriteriaRequest;
use App\Http\Requests\UpdateKriteriaRequest;
use App\Models\Kriteria;
use Illuminate\Http\Request;

class KriteriaController extends Controller
{
    /**
     * Function untuk menampilkan tampilan List Kriteria
     */
    public function index()
    {
        $kriterias = Kriteria::all(); // Get seluruh data Kriteria dari database
        return view('content.kriteria.index', compact('kriterias'));
    }

    /**
     * Function untuk menampilkan tampilan Tambah Kriteria
     */
    public function create()
    {
        return view('content.kriteria.create');
    }

    /**
     * Function untuk menerima inputan dari tampilan Tambah Kriteria
     * @param StoreKriteriaRequest $request | Untuk validasi input dari tampilan Tambah Kriteria
     */
    public function store(StoreKriteriaRequest $request)
    {
        Kriteria::create($request->validated()); // Insert data yang di input kedalam database

        return redirect()->route('kriterias.index')->with('message', 'Successfully adding new Kriteria');
    }

    /**
     * Function untuk menampilkan tampilan Edit Kriteria
     */
    public function edit(Kriteria $kriteria)
    {
        return view('content.kriteria.edit', compact('kriteria'));
    }

    /**
     * Function untuk menerima inputan dari tampilan Ubah Kriteria
     * @param UpdateKriteriaRequest $request | Untuk validasi input dari tampilan Ubah Kriteria
     */
    public function update(UpdateKriteriaRequest $request, Kriteria $kriteria)
    {
        $kriteria->update($request->validated()); // Update data Kriteria dalam database
        return redirect()->route('kriterias.index')->with('message', "Successfully update Kriteria");
    }

    /**
     * Function untuk menghapus kriteria terpilih
     */
    public function destroy(Kriteria $kriteria)
    {
        $kriteria->delete();
        return redirect()->route('kriterias.index')->with('message', "Successfully delete Kriteria \"{$kriteria->name}\"");
    }
}
