<?php

namespace App\Http\Controllers;

use App\Models\AlamatUser;
use App\Models\City;
use App\Models\Province;
use App\Models\Subdistrict;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;

class RajaOngkirController extends Controller
{
    /**
     * Menampilkan daftar provinsi dari database lokal
     * atau API jika DB lokal kosong.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // 1. Coba ambil data provinsi dari database lokal
        $provinces = Province::orderBy('name', 'asc')->get();

        // 2. Jika database lokal kosong (misal: baru pertama kali), ambil dari API
        if ($provinces->isEmpty()) {
            $response = Http::withHeaders([
                'Accept' => 'application/json',
                'key' => config('rajaongkir.api_key'),
            ])->get('https://rajaongkir.komerce.id/api/v1/destination/province');

            if ($response->successful()) {
                // Mengambil data provinsi dari respons JSON (API)
                $provinces = collect($response->json()['data'] ?? []);
            } else {
                // Jika API gagal dan DB kosong, kirim array kosong
                $provinces = collect([]);
            }
        }

        // returning the view with provinces data
        return view('user.accounts.account-add-address', compact('provinces'));
    }

    /**
     * Mengambil data kota berdasarkan ID provinsi
     *
     * @param int $provinceId (Ini adalah Raja Ongkir ID)
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCities($provinceId)
    {
        // KODE ANDA YANG INI SUDAH TEPAT UNTUK MENGAMBIL DATA KOTA DARI API
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'key' => config('rajaongkir.api_key'),
        ])->get("https://rajaongkir.komerce.id/api/v1/destination/city/{$provinceId}");

        if ($response->successful()) {
            return response()->json($response->json()['data'] ?? []);
        }

        // Jika gagal, kembalikan array kosong
        return response()->json([]);
    }

    /**
     * Mengambil data kecamatan berdasarkan ID kota
     *
     * @param int $cityId (Ini adalah Raja Ongkir ID)
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDistricts($cityId)
    {
        // KODE ANDA YANG INI SUDAH TEPAT UNTUK MENGAMBIL DATA KECAMATAN DARI API
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'key' => config('rajaongkir.api_key'),
        ])->get("https://rajaongkir.komerce.id/api/v1/destination/district/{$cityId}");

        if ($response->successful()) {
            return response()->json($response->json()['data'] ?? []);
        }

        // Jika gagal, kembalikan array kosong
        return response()->json([]);
    }

    public function store(Request $request)
    {
        // ... (Kode Validasi dan store Anda) ...

        $request->validate([
            'province_id' => 'required', // Ini adalah Raja Ongkir ID
            'city_id' => 'required',
            'subdistrict_id' => 'required',
            // ... (validasi lain)
        ]);

        // Perbaikan Logic: Ketika firstOrCreate, kita harus menggunakan rajaongkir_province_id
        // sebagai acuan di WHERE clause (kolom pertama)

        // 1. PROVINCE
        $province = Province::firstOrCreate(
            ['rajaongkir_province_id' => $request->province_id], // Cari berdasarkan RO ID
            ['name' => $request->province_name] // Buat jika tidak ada
        );

        // 2. CITY
        $city = City::firstOrCreate(
            ['rajaongkir_city_id' => $request->city_id], // Cari berdasarkan RO ID
            [
                // Perhatian: province_id di sini harus berisi Primary Key dari Province lokal!
                'province_id' => $province->getKey(), // Mengambil Primary Key: city_id
                'name' => $request->city_name,
                'postal_code' => $request->postal_code ?? '-',
            ]
        );

        // 3. SUBDISTRICT
        $subdistrict = Subdistrict::firstOrCreate(
            ['rajaongkir_subdistrict_id' => $request->subdistrict_id], // Cari berdasarkan RO ID
            [
                'city_id' => $city->getKey(), // Mengambil Primary Key: subdistrict_id
                'name' => $request->subdistrict_name
            ]
        );

        // 4. ALAMAT USER
        AlamatUser::create([
            'user_id' => Auth::id(),
            // Simpan Primary Key LOKAL ke Foreign Key AlamatUser
            'province_id' => $province->getKey(),
            'city_id' => $city->getKey(),
            'subdistrict_id' => $subdistrict->getKey(),
            'alamat_lengkap' => $request->alamat_lengkap,
            'nama_penerima' => $request->nama_penerima,
            'no_tlp' => $request->no_tlp,
            'nama_alamat' => $request->nama_alamat,
        ]);

        return redirect()->back()->with('success', 'Alamat berhasil disimpan!');
    }
    public function showAddresses()
    {
        $addresses = AlamatUser::with(['province', 'city', 'subdistrict'])
            ->where('user_id', Auth::id())
            ->get();
        return view('user.accounts.account-address', compact('addresses'));
    }
}
