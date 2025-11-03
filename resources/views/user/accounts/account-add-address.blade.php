@extends('user.layouts.accounts')
@section('title', 'Add Address')
@section('content')
    <div class="page-content my-account__address">
        <div class="row">
            <div class="col-6">
                <p class="notice">The following addresses will be used on the checkout page by default.</p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="card mb-5">
                    <div class="card-header">
                        <h5>Tambah Alamat Baru</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('account-address.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                {{-- Nama Penerima --}}
                                <div class="col-md-12">
                                    <div class="form-floating my-3">
                                        <input type="text" class="form-control" name="nama_penerima" required>
                                        <label>Nama Penerima *</label>
                                    </div>
                                </div>

                                {{-- Provinsi --}}
                                <div class="col-md-4">
                                    <div class="form-floating my-3">
                                        <select class="form-select" id="province" name="province_id" required>
                                            <option value="">-- Pilih Provinsi --</option>
                                            @foreach ($provinces as $province)
                                                {{-- PERUBAHAN DI SINI --}}
                                                {{-- Gunakan $province->rajaongkir_province_id jika $provinces adalah Collection of Models (dari DB lokal) --}}
                                                {{-- Gunakan $province['id'] jika $provinces adalah Array (dari API) --}}

                                                @php
                                                    // Cek apakah ini Model atau Array
                                                    $isModel = $province instanceof \Illuminate\Database\Eloquent\Model;
                                                    $idValue = $isModel
                                                        ? $province->rajaongkir_province_id
                                                        : $province['id'];
                                                    $nameValue = $isModel ? $province->name : $province['name'];
                                                @endphp

                                                <option value="{{ $idValue }}" data-name="{{ $nameValue }}">
                                                    {{ $nameValue }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <label>Provinsi *</label>
                                    </div>
                                </div>

                                {{-- Kota --}}
                                <div class="col-md-4">
                                    <div class="form-floating my-3">
                                        <select class="form-select" id="city" name="city_id" required>
                                            <option value="">-- Pilih Kota/Kabupaten --</option>
                                        </select>
                                        <label>Kabupaten/Kota *</label>
                                    </div>
                                </div>

                                {{-- Kecamatan --}}
                                <div class="col-md-4">
                                    <div class="form-floating my-3">
                                        <select class="form-select" id="subdistrict" name="subdistrict_id" required>
                                            <option value="">-- Pilih Kecamatan --</option>
                                        </select>
                                        <label>Kecamatan *</label>
                                    </div>
                                </div>

                                {{-- Alamat Lengkap --}}
                                <div class="col-md-12">
                                    <div class="form-floating my-3">
                                        <input type="text" class="form-control" name="alamat_lengkap" required>
                                        <label>Alamat Lengkap (Jl, No Rumah, Gedung) *</label>
                                    </div>
                                </div>

                                {{-- Nama Alamat --}}
                                <div class="col-md-6">
                                    <div class="form-floating my-3">
                                        <input type="text" class="form-control" name="nama_alamat" required>
                                        <label>Nama Alamat (misal: Rumah, Kantor, dll) *</label>
                                    </div>
                                </div>

                                {{-- No Telepon --}}
                                <div class="col-md-6">
                                    <div class="form-floating my-3">
                                        <input type="text" class="form-control" name="no_tlp" required>
                                        <label>No Telepon *</label>
                                    </div>
                                </div>

                                <div class="col-md-12 text-end">
                                    <button type="submit" class="btn btn-success">Simpan Alamat</button>
                                </div>
                            </div>

                            {{-- Hidden input untuk menyimpan nama provinsi/kota/kecamatan --}}
                            <input type="hidden" name="province_name">
                            <input type="hidden" name="city_name">
                            <input type="hidden" name="subdistrict_name">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {

            // Provinsi -> Kota
            $('select[name="province_id"]').on('change', function() {
                let provinceId = $(this).val();
                let provinceName = $(this).find('option:selected').data('name');
                $('input[name="province_name"]').val(provinceName);

                if (provinceId) {
                    $.ajax({
                        url: `/user/account/account-address/add-address/cities/${provinceId}`,
                        type: "GET",
                        dataType: "json",
                        success: function(response) {
                            $('select[name="city_id"]').empty().append(
                                `<option value="">-- Pilih Kota / Kabupaten --</option>`);
                            $('select[name="subdistrict_id"]').empty().append(
                                `<option value="">-- Pilih Kecamatan --</option>`);
                            $.each(response, function(index, value) {
                                $('select[name="city_id"]').append(
                                    `<option value="${value.id}" data-name="${value.name}">${value.name}</option>`
                                    );
                            });
                        }
                    });
                }
            });

            // Kota -> Kecamatan
            $('select[name="city_id"]').on('change', function() {
                let cityId = $(this).val();
                let cityName = $(this).find('option:selected').data('name');
                $('input[name="city_name"]').val(cityName);

                if (cityId) {
                    $.ajax({
                        url: `/user/account/account-address/add-address/districts/${cityId}`,
                        type: "GET",
                        dataType: "json",
                        success: function(response) {
                            $('select[name="subdistrict_id"]').empty().append(
                                `<option value="">-- Pilih Kecamatan --</option>`);
                            $.each(response, function(index, value) {
                                $('select[name="subdistrict_id"]').append(
                                    `<option value="${value.id}" data-name="${value.name}">${value.name}</option>`
                                    );
                            });
                        }
                    });
                }
            });

            // Simpan nama kecamatan
            $('select[name="subdistrict_id"]').on('change', function() {
                let subdistrictName = $(this).find('option:selected').data('name');
                $('input[name="subdistrict_name"]').val(subdistrictName);
            });

        });
    </script>
@endsection
