<?php

namespace App\Http\Controllers;

use App\Models\Sablon;
use App\Models\Ukuran;
use App\Models\Warna;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Bahan;

class komponenController extends Controller
{
    use HasFactory;

    public function index()
    {
        $bahans = Bahan::all();
        $ukurans = Ukuran::all();
        $warnas = Warna::all();
        $sablons = Sablon::all();
        return view('admin.komponen.komponenBarang', compact(
            'bahans',
            'ukurans',
            'warnas',
            'sablons'
        ));
    }

    public function bahanindex()
    {
        $bahan = Bahan::all();
        return view('admin.komponen.komponenBarang', compact('bahan'));
    }
    public function ukuranindex()
    {
        $ukuran = Ukuran::all();
        return view('admin.komponen.komponenBarang', compact('ukuran'));
    }
    public function warnaindex()
    {
        $warna = Warna::all();
        return view('admin.komponen.komponenBarang', compact('warna'));
    }
    public function sablonindex()
    {
        $sablon = Sablon::all();
        return view('admin.komponen.komponenBarang', compact('sablon'));
    }

    public function bahancreate()
    {
        return view('admin.komponen.komponenBarang');
    }
    public function ukurancreate()
    {
        return view('admin.komponen.komponenBarang');
    }
    public function warnacreate()
    {
        return view('admin.komponen.komponenBarang');
    }
    public function sabloncreate()
    {
        return view('admin.komponen.komponenBarang');
    }

    public function bahanstore(Request $request)
    {
        $request->validate([
            'nama_bahan' => 'required',
            'ketebalan_bahan' => 'required',
            'harga_bahan' => 'required|numeric',
        ]);

        Bahan::create($request->all());
        return redirect()->route('admin.komponen.komponenBarang')->with('success', 'Bahan berhasil ditambahkan');
    }

    public function ukuranstore(Request $request)
    {
        $request->validate([
            'ukuran' => 'required',
            'harga_ukuran' => 'required|numeric',
        ]);

        Ukuran::create($request->all());
        return redirect()->route('admin.komponen.komponenBarang')->with('success', 'Ukuran berhasil ditambahkan');
    }

    public function warnastore(Request $request)
    {
        $request->validate([
            'nama_warna' => 'required',
            'kode_hex' => 'required',
            'harga_warna' => 'required|numeric',
        ]);

        Warna::create($request->all());
        return redirect()->route('admin.komponen.komponenBarang')->with('success', 'Warna berhasil ditambahkan');
    }

    public function sablonstore(Request $request)
    {
        $request->validate([
            'nama_sablon' => 'required',
            'ukuran_sablon' => 'required',
            'harga_sablon' => 'required|numeric',
            'gambar_sablon' => 'required|image|mimes:jpeg,png,jpg,svg|max:10800',
        ]);

        $data = $request->all();
        if ($request->hasFile('gambar_sablon')) {
            $data['gambar_sablon'] = $request->file('gambar_sablon')->store('sablons', 'public');
        }

        Sablon::create($data);
        return redirect()->route('admin.komponen.komponenBarang')->with('success', 'Sablon berhasil ditambahkan');
    }

    public function bahanedit(Bahan $bahan)
    {
        return view('admin.komponen.komponenBarang', compact('bahan'));
    }
    public function ukuranedit(Ukuran $ukuran)
    {
        return view('admin.komponen.komponenBarang', compact('ukuran'));
    }
    public function warnaedit(Warna $warna)
    {
        return view('admin.komponen.komponenBarang', compact('warna'));
    }
    public function sablonedit(Sablon $sablon)
    {
        return view('admin.komponen.komponenBarang', compact('sablon'));
    }

    public function bahanupdate(Request $request, Bahan $bahan)
    {
        $request->validate([
            'nama_bahan' => 'required',
            'ketebalan_bahan' => 'required',
            'harga_bahan' => 'required|numeric',
        ]);
        $databahan = $request->only('nama_bahan', 'ketebalan_bahan', 'harga_bahan');
        $bahan->update($databahan);
        return redirect()->route('admin.komponen.komponenBarang')->with('success', 'Bahan updated successfully.');
    }
    public function ukuranupdate(Request $request, Ukuran $ukuran)
    {
        $request->validate([
            'ukuran' => 'required',
            'harga_ukuran' => 'required|numeric',
        ]);
        $dataukuran = $request->only('ukuran', 'harga_ukuran');
        $ukuran->update($dataukuran);
        return redirect()->route('admin.komponen.komponenBarang')->with('success', 'Ukuran updated successfully.');
    }
    public function warnaupdate(Request $request, Warna $warna)
    {
        $request->validate([
            'nama_warna' => 'required',
            'kode_hex' => 'required',
            'harga_warna' => 'required|numeric',
        ]);
        $datawarna = $request->only('nama_warna', 'kode_hex', 'harga_warna');
        $warna->update($datawarna);
        return redirect()->route('admin.komponen.komponenBarang')->with('success', 'Warna updated successfully.');
    }
    public function sablonupdate(Request $request, Sablon $sablon)
    {
        $request->validate([
            'nama_sablon' => 'required',
            'ukuran_sablon' => 'required',
            'gambar_sablon' => 'image|mimes:jpeg,png,jpg,svg|max:10800',
            'harga_sablon' => 'required|numeric',
        ]);
        $datasablon = $request->only('nama_sablon', 'ukuran_sablon', 'harga_sablon');
        if ($request->hasFile('gambar_sablon')) {
            $datasablon['gambar_sablon'] = $request->file('gambar_sablon')->store('sablons', 'public');
        }
        $sablon->update($datasablon);
        return redirect()->route('admin.komponen.komponenBarang')->with('success', 'Sablon updated successfully.');
    }

    public function bahandestroy(Bahan $bahan)
    {
        $bahan->delete();
        return redirect()->route('admin.komponen.komponenBarang')->with('success', 'Bahan deleted successfully.');
    }
    public function ukurandestroy(Ukuran $ukuran)
    {
        $ukuran->delete();
        return redirect()->route('admin.komponen.komponenBarang')->with('success', 'Ukuran deleted successfully.');
    }
    public function warnadestroy(Warna $warna)
    {
        $warna->delete();
        return redirect()->route('admin.komponen.komponenBarang')->with('success', 'Warna deleted successfully.');
    }
    public function sablondestroy(Sablon $sablon)
    {
        $sablon->delete();
        return redirect()->route('admin.komponen.komponenBarang')->with('success', 'Sablon deleted successfully.');
    }
}
