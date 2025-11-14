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
     * Menampilkan daftar provinsi dari Database Lokal
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // PERBAIKAN: Mengambil data provinsi dari Database Lokal
        // Karena data dari RajaOngkir sering bermasalah atau tidak konsisten
        // serta untuk menghindari error "Attempt to read property... on array"
        // di view saat menggunakan data dummy.
        $provinces = Province::all(); // Mengambil semua data dari model Province

        // returning the view with provinces data
        return view('user.accounts.account-add-address', compact('provinces')); // [cite: 5]
    }
    
    // ... SISA KODE LAINNYA TETAP SAMA ...

    /**
     * Mengambil data kota berdasarkan ID provinsi
     *
     * @param int $provinceId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCities($provinceId)
    {
        // Mengambil data kota berdasarkan ID provinsi dari API Raja Ongkir [cite: 6, 7]
        $response = Http::withHeaders([

            //headers yang diperlukan untuk API Raja Ongkir
    
            'Accept' => 'application/json', // [cite: 7]
            'key' => config('rajaongkir.api_key'), // [cite: 7]

        ])->get("https://rajaongkir.komerce.id/api/v1/destination/city/{$provinceId}"); // [cite: 7]
        
        if ($response->successful()) { // [cite: 8]

            // Mengambil data kota dari respons JSON
            // Jika 'data' tidak ada, inisialisasi dengan array kosong
            return response()->json($response->json()['data'] ?? []); // [cite: 8, 9]
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
        // Mengambil data kecamatan berdasarkan ID kota dari API Raja Ongkir [cite: 9, 10]
        $response = Http::withHeaders([

            //headers yang diperlukan untuk API Raja Ongkir
            'Accept' => 'application/json', // [cite: 10]
            'key' => config('rajaongkir.api_key'), // [cite: 10]

        ])->get("https://rajaongkir.komerce.id/api/v1/destination/district/{$cityId}"); // [cite: 10]
        
        if ($response->successful()) { // [cite: 11]

            // Mengambil data kecamatan dari respons JSON
            // Jika 'data' tidak ada, inisialisasi dengan array kosong
            return response()->json($response->json()['data'] ?? []); // [cite: 11, 12]
        }
    }

    /**
     * Menghitung ongkos kirim berdasarkan data yang diberikan
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkOngkir(Request $request) // [cite: 12]
    {
        $response = Http::asForm()->withHeaders([

            //headers yang diperlukan untuk API Raja Ongkir
            'Accept' => 'application/json',
  
            'key'    => config('rajaongkir.api_key'), // [cite: 13]

        ])->post('https://rajaongkir.komerce.id/api/v1/calculate/domestic-cost', [ // [cite: 13]
            'origin'      => 3855, // ID kecamatan Diwek (ganti sesuai kebutuhan)
            'destination' => $request->input('subdistrict_id'), // ID kecamatan tujuan
            'weight'      => $request->input('weight'), // Berat dalam gram
         
            'courier'     => $request->input('courier'), // Kode kurir (jne, tiki, pos) // [cite: 14]
        ]);
        
        if ($response->successful()) { // [cite: 15]

            // Mengambil data ongkos kirim dari respons JSON
            // Jika 'data' tidak ada, inisialisasi dengan array kosong
            return $response->json()['data'] ?? // [cite: 15, 16]
            [];
        }
    }

    public function showAddresses() // [cite: 16]
    {
        $addresses = AlamatUser::with(['province', 'city', 'subdistrict'])
            ->where('user_id', Auth::id())
            ->get();
        // Melewatkan variabel $addresses ke view
        return view('user.accounts.account-address', compact('addresses')); // [cite: 17]
    }
    
    public function store(Request $request) // [cite: 18]
    {
        $request->validate([
            'province_id' => 'required|numeric',
            'city_id' => 'required|numeric',
            'subdistrict_id' => 'required|numeric',
            'province_name' => 'required|string',
            'city_name' => 'required|string',
           
            'subdistrict_name' => 'required|string', // [cite: 19]
            'alamat_lengkap' => 'required|string',
            'nama_penerima' => 'required|string',
            'no_tlp' => 'required|string',
            'nama_alamat' => 'required|string',
        ]);
        // Simpan atau ambil provinsi
        $province = Province::firstOrCreate( // [cite: 20]
            ['rajaongkir_province_id' => $request->province_id],
            ['name' => $request->province_name]
        );
        // Simpan atau ambil kota
        $city = City::firstOrCreate( // [cite: 21]
            ['rajaongkir_city_id' => $request->city_id],
            [
                'province_id' => $province->province_id,
                'name' => $request->city_name,
                'postal_code' => '00000'
      
            ] // [cite: 22]
        );
        // Simpan atau ambil kecamatan
        $subdistrict = Subdistrict::firstOrCreate( // [cite: 23]
            ['rajaongkir_subdistrict_id' => $request->subdistrict_id],
            [
                'city_id' => $city->city_id,
                'name' => $request->subdistrict_name
            ]
        );
        // Simpan alamat user
        AlamatUser::create([ // [cite: 24]
            'user_id' => Auth::id(),
            'province_id' => $province->province_id,
            'city_id' => $city->city_id,
            'subdistrict_id' => $subdistrict->subdistrict_id,
            'alamat_lengkap' => $request->alamat_lengkap,
            'nama_penerima' => $request->nama_penerima,
     
            'no_tlp' => $request->no_tlp, // [cite: 25]
            'nama_alamat' => $request->nama_alamat,
        ]);
        
        return redirect()->back()->with('success', 'Alamat berhasil disimpan!'); // [cite: 26]
    }
    
    public function edit($id) // [cite: 26]
    {
        $alamat = AlamatUser::where('id_alamat_user', $id)->firstOrFail(); // 
        $provinces = Province::all(); // 

        return view('user.accounts.account-add-address', compact('alamat', 'provinces')); // 
    }
    
    public function update(Request $request, $id) // [cite: 27]
    {
        $request->validate([
            'province_id' => 'required|numeric',
            'city_id' => 'required|numeric',
            'subdistrict_id' => 'required|numeric',
            'province_name' => 'required|string',
            'city_name' => 'required|string',
   
            'subdistrict_name' => 'required|string', // [cite: 28]
            'alamat_lengkap' => 'required|string',
            'nama_penerima' => 'required|string',
            'no_tlp' => 'required|string',
            'nama_alamat' => 'required|string',
        ]);
        
        $alamat = AlamatUser::where('id_alamat_user', $id)->firstOrFail(); // [cite: 29]

        // Cek apakah user mengubah wilayah
        $isWilayahChanged = ( // [cite: 29]
            $alamat->province_id != $request->province_id ||
            $alamat->city_id != $request->city_id ||
            $alamat->subdistrict_id != $request->subdistrict_id
        );
        
        // Jika wilayah berubah → ambil data baru (dari API RajaOngkir jika perlu)
        if ($isWilayahChanged) { // [cite: 30]

            // Simpan / ambil provinsi
            $province = Province::firstOrCreate( // [cite: 30]
                ['rajaongkir_province_id' => $request->province_id],
                ['name' => $request->province_name]
            
            ); // [cite: 31]

            // Simpan / ambil kota (pastikan postal_code diupdate)
            $city = City::where('rajaongkir_city_id', $request->city_id)->first(); // [cite: 32]
            
            if (!$city) { // [cite: 32]
                // Jika belum ada, ambil postal code dari API RajaOngkir
                $apiKey = config('rajaongkir.api_key'); // [cite: 32, 33]
                
                $response = Http::withHeaders([ // [cite: 33]
                    'key' => $apiKey
                ])->get("https://api.rajaongkir.com/starter/city?id={$request->city_id}"); // [cite: 33]
                
                $postalCode = '00000'; // [cite: 34]
                if ($response->successful()) { // [cite: 34]
                    $data = $response->json()['rajaongkir']['results']; // [cite: 35]
                    $postalCode = $data['postal_code']; // [cite: 35]
                }

                $city = City::create([ // [cite: 36]
                    'rajaongkir_city_id' => $request->city_id,
                    'province_id' => $province->province_id,
                    'name' => $request->city_name,
             
                    'postal_code' => $postalCode // [cite: 36]
                ]);
            } // [cite: 37]

            // Simpan / ambil kecamatan
            $subdistrict = Subdistrict::firstOrCreate( // [cite: 37]
                ['rajaongkir_subdistrict_id' => $request->subdistrict_id],
                [
                    'city_id' => $city->city_id,
              
                    'name' => $request->subdistrict_name // [cite: 38]
                ]
            );
            
            // Update alamat dengan wilayah baru
            $alamat->update([ // [cite: 39]
                'province_id' => $province->province_id,
                'city_id' => $city->city_id,
                'subdistrict_id' => $subdistrict->subdistrict_id,
                'alamat_lengkap' => $request->alamat_lengkap,
           
                'nama_penerima' => $request->nama_penerima, // [cite: 40]
                'no_tlp' => $request->no_tlp,
                'nama_alamat' => $request->nama_alamat,
            ]);
        } else { // [cite: 41]
            // Jika wilayah tidak berubah, update data biasa saja
            $alamat->update([ // [cite: 41]
                'alamat_lengkap' => $request->alamat_lengkap,
                'nama_penerima' => $request->nama_penerima,
                'no_tlp' => $request->no_tlp,
            
                'nama_alamat' => $request->nama_alamat, // [cite: 42]
            ]);
        } // [cite: 43]

        return redirect()->back()->with('success', 'Alamat berhasil diperbarui!'); // [cite: 44]
    }
    public function destroy($id) // [cite: 44]
    {
        $alamat = AlamatUser::where('id_alamat_user', $id)->firstOrFail(); // [cite: 45]
        $alamat->delete(); // [cite: 45]

        return redirect()->back()->with('success', 'Alamat berhasil dihapus!'); // [cite: 46]
    }
}
