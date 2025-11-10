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
     * Menampilkan daftar provinsi dari API Raja Ongkir
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Mengambil data provinsi dari API Raja Ongkir
        $response = Http::withHeaders([

            //headers yang diperlukan untuk API Raja Ongkir
            'Accept' => 'application/json',
            'key' => config('rajaongkir.api_key'),

        ])->get('https://rajaongkir.komerce.id/api/v1/destination/province');

        // Memeriksa apakah permintaan berhasil
        if ($response->successful()) {

            // Mengambil data provinsi dari respons JSON
            // Jika 'data' tidak ada, inisialisasi dengan array kosong
            $provinces = $response->json()['data'] ?? [];
        }

        // returning the view with provinces data
        return view('user.accounts.account-add-address', compact('provinces'));
    }

    /**
     * Mengambil data kota berdasarkan ID provinsi
     *
     * @param int $provinceId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCities($provinceId)
    {
        // Mengambil data kota berdasarkan ID provinsi dari API Raja Ongkir
        $response = Http::withHeaders([

            //headers yang diperlukan untuk API Raja Ongkir
            'Accept' => 'application/json',
            'key' => config('rajaongkir.api_key'),

        ])->get("https://rajaongkir.komerce.id/api/v1/destination/city/{$provinceId}");

        if ($response->successful()) {

            // Mengambil data kota dari respons JSON
            // Jika 'data' tidak ada, inisialisasi dengan array kosong
            return response()->json($response->json()['data'] ?? []);
        }
    }

    /**
     * Mengambil data kecamatan berdasarkan ID kota
     *
     * @param int $cityId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDistricts($cityId)
    {
        // Mengambil data kecamatan berdasarkan ID kota dari API Raja Ongkir
        $response = Http::withHeaders([

            //headers yang diperlukan untuk API Raja Ongkir
            'Accept' => 'application/json',
            'key' => config('rajaongkir.api_key'),

        ])->get("https://rajaongkir.komerce.id/api/v1/destination/district/{$cityId}");

        if ($response->successful()) {

            // Mengambil data kecamatan dari respons JSON
            // Jika 'data' tidak ada, inisialisasi dengan array kosong
            return response()->json($response->json()['data'] ?? []);
        }
    }

    /**
     * Menghitung ongkos kirim berdasarkan data yang diberikan
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkOngkir(Request $request)
    {
        $response = Http::asForm()->withHeaders([

            //headers yang diperlukan untuk API Raja Ongkir
            'Accept' => 'application/json',
            'key'    => config('rajaongkir.api_key'),

        ])->post('https://rajaongkir.komerce.id/api/v1/calculate/domestic-cost', [
            'origin'      => 3855, // ID kecamatan Diwek (ganti sesuai kebutuhan)
            'destination' => $request->input('subdistrict_id'), // ID kecamatan tujuan
            'weight'      => $request->input('weight'), // Berat dalam gram
            'courier'     => $request->input('courier'), // Kode kurir (jne, tiki, pos)
        ]);

        if ($response->successful()) {

            // Mengambil data ongkos kirim dari respons JSON
            // Jika 'data' tidak ada, inisialisasi dengan array kosong
            return $response->json()['data'] ?? [];
        }
    }

    public function showAddresses()
    {
        $addresses = AlamatUser::with(['province', 'city', 'subdistrict'])
            ->where('user_id', Auth::id())
            ->get();

        // Melewatkan variabel $addresses ke view
        return view('user.accounts.account-address', compact('addresses'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'province_id' => 'required|numeric',
            'city_id' => 'required|numeric',
            'subdistrict_id' => 'required|numeric',
            'province_name' => 'required|string',
            'city_name' => 'required|string',
            'subdistrict_name' => 'required|string',
            'alamat_lengkap' => 'required|string',
            'nama_penerima' => 'required|string',
            'no_tlp' => 'required|string',
            'nama_alamat' => 'required|string',
        ]);

        // Simpan atau ambil provinsi
        $province = Province::firstOrCreate(
            ['rajaongkir_province_id' => $request->province_id],
            ['name' => $request->province_name]
        );

        // Simpan atau ambil kota
        $city = City::firstOrCreate(
            ['rajaongkir_city_id' => $request->city_id],
            [
                'province_id' => $province->province_id,
                'name' => $request->city_name,
                'postal_code' => '00000'
            ]
        );

        // Simpan atau ambil kecamatan
        $subdistrict = Subdistrict::firstOrCreate(
            ['rajaongkir_subdistrict_id' => $request->subdistrict_id],
            [
                'city_id' => $city->city_id,
                'name' => $request->subdistrict_name
            ]
        );

        // Simpan alamat user
        AlamatUser::create([
            'user_id' => Auth::id(),
            'province_id' => $province->province_id,
            'city_id' => $city->city_id,
            'subdistrict_id' => $subdistrict->subdistrict_id,
            'alamat_lengkap' => $request->alamat_lengkap,
            'nama_penerima' => $request->nama_penerima,
            'no_tlp' => $request->no_tlp,
            'nama_alamat' => $request->nama_alamat,
        ]);

        return redirect()->back()->with('success', 'Alamat berhasil disimpan!');
    }
    public function edit($id)
    {
        $alamat = AlamatUser::where('id_alamat_user',$id)->firstOrFail();
        $provinces = Province::all();

        return view('user.accounts.account-add-address', compact('alamat', 'provinces'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'province_id' => 'required|numeric',
            'city_id' => 'required|numeric',
            'subdistrict_id' => 'required|numeric',
            'province_name' => 'required|string',
            'city_name' => 'required|string',
            'subdistrict_name' => 'required|string',
            'alamat_lengkap' => 'required|string',
            'nama_penerima' => 'required|string',
            'no_tlp' => 'required|string',
            'nama_alamat' => 'required|string',
        ]);

        $alamat = AlamatUser::where('id_alamat_user',$id)->firstOrFail();

        // Cek apakah user mengubah wilayah
        $isWilayahChanged = (
            $alamat->province_id != $request->province_id ||
            $alamat->city_id != $request->city_id ||
            $alamat->subdistrict_id != $request->subdistrict_id
        );

        // Jika wilayah berubah → ambil data baru (dari API RajaOngkir jika perlu)
        if ($isWilayahChanged) {

            // Simpan / ambil provinsi
            $province = Province::firstOrCreate(
                ['rajaongkir_province_id' => $request->province_id],
                ['name' => $request->province_name]
            );

            // Simpan / ambil kota (pastikan postal_code diupdate)
            $city = City::where('rajaongkir_city_id', $request->city_id)->first();

            if (!$city) {
                // Jika belum ada, ambil postal code dari API RajaOngkir
                $apiKey = config('rajaongkir.api_key');
                $response = Http::withHeaders([
                    'key' => $apiKey
                ])->get("https://api.rajaongkir.com/starter/city?id={$request->city_id}");

                $postalCode = '00000';
                if ($response->successful()) {
                    $data = $response->json()['rajaongkir']['results'];
                    $postalCode = $data['postal_code'];
                }

                $city = City::create([
                    'rajaongkir_city_id' => $request->city_id,
                    'province_id' => $province->province_id,
                    'name' => $request->city_name,
                    'postal_code' => $postalCode
                ]);
            }

            // Simpan / ambil kecamatan
            $subdistrict = Subdistrict::firstOrCreate(
                ['rajaongkir_subdistrict_id' => $request->subdistrict_id],
                [
                    'city_id' => $city->city_id,
                    'name' => $request->subdistrict_name
                ]
            );

            // Update alamat dengan wilayah baru
            $alamat->update([
                'province_id' => $province->province_id,
                'city_id' => $city->city_id,
                'subdistrict_id' => $subdistrict->subdistrict_id,
                'alamat_lengkap' => $request->alamat_lengkap,
                'nama_penerima' => $request->nama_penerima,
                'no_tlp' => $request->no_tlp,
                'nama_alamat' => $request->nama_alamat,
            ]);
        } else {
            // Jika wilayah tidak berubah, update data biasa saja
            $alamat->update([
                'alamat_lengkap' => $request->alamat_lengkap,
                'nama_penerima' => $request->nama_penerima,
                'no_tlp' => $request->no_tlp,
                'nama_alamat' => $request->nama_alamat,
            ]);
        }

        return redirect()->back()->with('success', 'Alamat berhasil diperbarui!');
    }
}
