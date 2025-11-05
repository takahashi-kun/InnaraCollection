<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\jasa;

class jasaController extends Controller
{
     public function index()
    {
        $daftarJasa = Jasa::all();
        $totalHargaJasa = $daftarJasa->sum('harga_jasa');
        return view('admin.jasa.index', compact('daftarJasa','totalHargaJasa'));
    }

    public function edit($id_jasa)
    {
        $editJasa = Jasa::findOrFail($id_jasa);
        $daftarJasa = Jasa::all();
        $totalHargaJasa = $daftarJasa->sum('harga_jasa');
        return view('admin.jasa.index', compact('editJasa','daftarJasa','totalHargaJasa'));
    }

    public function update(Request $request, $id_jasa)
    {
        $request->validate([
            'harga_jasa' => 'required|numeric|min:0',
        ]);

        $jasa = Jasa::findOrFail($id_jasa);
        $jasa->update([
            'harga_jasa' => $request->harga_jasa,
        ]);

        return redirect()->route('admin.jasa.index')->with('success', 'Harga jasa berhasil diperbarui.');
    }
}
