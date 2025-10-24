<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\jasa;

class jasaController extends Controller
{
    public function index(){
        $jasa = jasa::all();
        return view('admin.jasa.index', compact('jasa'));
    }
    public function create(){
        return view('admin.jasa.index');
    }
    public function store(Request $request){
        $request->validate([
            'nama_jasa' => 'required|string',
            'harga_jasa' => 'required|numeric',
        ]);

        jasa::create([
            'nama_jasa' => $request->nama_jasa,
            'harga_jasa' => $request->harga_jasa,
        ]);

        return redirect()->route('admin.jasa')->with('success', 'Jasa berhasil ditambahkan.');
    }
    public function edit(jasa $jasa){
        return view('admin.jasa.index', compact('jasa'));
    }
    public function update(Request $request, jasa $jasa){
        $request->validate([
            'nama_jasa' => 'required|string',
            'harga_jasa' => 'required|numeric',
        ]);
        $jasa->update([
            'nama_jasa' => $request->nama_jasa,
            'harga_jasa' => $request->harga_jasa,
        ]);
        return redirect()->route('admin.jasa')->with('success', 'Jasa berhasil diperbarui.');
    }
    public function destroy(jasa $jasa){
        $jasa->delete();
        return redirect()->route('admin.jasa')->with('success', 'Jasa berhasil dihapus.');
    }
}
