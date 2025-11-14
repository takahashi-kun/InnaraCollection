@extends('user.layouts.accounts')
@section('title', 'Add Address')
@section('content')
    <div class="page-content my-account__address">
        <div class="row">
            <div class="col-6">
                <p class="notice">Alamat berikut akan digunakan pada halaman pembayaran.</p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="card mb-5">
                    <div class="card-header">
                        <h5>{{ isset($alamat) ? 'Edit Alamat' : 'Tambah Alamat Baru' }}</h5>
                    </div>
                    <div class="card-body">
                        <form
                            action="{{ isset($alamat) ? route('account-address.update', $alamat->id_alamat_user) : route('account-address.store') }}"
                            method="POST">
                            @csrf
                            @if (isset($alamat))
                                @method('PUT')
                            @endif

                            <div class="row">
                                {{-- Nama Penerima --}}
                                <div class="col-md-12">
                                    <div class="form-floating my-3">
                                        <input type="text" class="form-control" name="nama_penerima"
                                            value="{{ old('nama_penerima', $alamat->nama_penerima ?? '') }}" required>
                                        <label>Nama Penerima *</label>
                                    </div>
                                </div>

                                {{-- Provinsi --}}
                                <div class="col-md-4">
                                    <div class="form-floating my-3">
                                        <select class="form-select" id="province" name="province_id" required>
                                            <option value="">-- Pilih Provinsi --</option>
                                            @foreach ($provinces as $province)
                                                <option value="{{ $province->rajaongkir_province_id }}"
                                                    data-name="{{ $province->name }}"
                                                    {{ isset($alamat) && $alamat->province->rajaongkir_province_id == $province->rajaongkir_province_id ? 'selected' : '' }}>
                                                    {{ $province->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <label for="province">Provinsi *</label>
                                    </div>
                                </div>

                                {{-- Kota --}}
                                <div class="col-md-4">
                                    <div class="form-floating my-3">
                                        <select class="form-select" id="city" name="city_id" required>
                                            @if (isset($alamat))
                                                <option value="{{ $alamat->city->rajaongkir_city_id }}"
                                                    data-name="{{ $alamat->city->name }}" selected>
                                                    {{ $alamat->city->name }}
                                                </option>
                                            @else
                                                <option value="">-- Pilih Kota/Kabupaten --</option>
                                            @endif
                                        </select>
                                        <label for="city">Kabupaten/Kota *</label>
                                    </div>
                                </div>

                                {{-- Kecamatan --}}
                                <div class="col-md-4">
                                    <div class="form-floating my-3">
                                        <select class="form-select" name="subdistrict_id" id="subdistrict" required>
                                            @if (isset($alamat))
                                                <option value="{{ $alamat->subdistrict->rajaongkir_subdistrict_id }}"
                                                    data-name="{{ $alamat->subdistrict->name }}" selected>
                                                    {{ $alamat->subdistrict->name }}
                                                </option>
                                            @else
                                                <option value="">-- Pilih Kecamatan --</option>
                                            @endif
                                        </select>
                                        <label for="subdistrict">Kecamatan *</label>
                                    </div>
                                </div>

                                {{-- Alamat Lengkap --}}
                                <div class="col-md-12">
                                    <div class="form-floating my-3">
                                        <input type="text" class="form-control" name="alamat_lengkap"
                                            value="{{ old('alamat_lengkap', $alamat->alamat_lengkap ?? '') }}" required>
                                        <label>Alamat Lengkap (Jl, No Rumah, Gedung) *</label>
                                    </div>
                                </div>

                                {{-- Nama Alamat --}}
                                <div class="col-md-6">
                                    <div class="form-floating my-3">
                                        <input type="text" class="form-control" name="nama_alamat"
                                            value="{{ old('nama_alamat', $alamat->nama_alamat ?? '') }}" required>
                                        <label>Nama Alamat (misal: Rumah, Kantor, dll) *</label>
                                    </div>
                                </div>

                                {{-- No Telepon --}}
                                <div class="col-md-6">
                                    <div class="form-floating my-3">
                                        <input type="text" class="form-control" name="no_tlp"
                                            value="{{ old('no_tlp', $alamat->no_tlp ?? '') }}" required>
                                        <label>No Telepon *</label>
                                    </div>
                                </div>

                                <div class="col-md-12 text-end">
                                    <button type="submit" class="btn btn-success">
                                        {{ isset($alamat) ? 'Update Alamat' : 'Simpan Alamat' }}
                                    </button>
                                </div>
                            </div>

                            <input type="hidden" name="province_name"
                                value="{{ old('province_name', $alamat->province->name ?? '') }}">
                            <input type="hidden" name="city_name"
                                value="{{ old('city_name', $alamat->city->name ?? '') }}">
                            <input type="hidden" name="subdistrict_name"
                                value="{{ old('subdistrict_name', $alamat->subdistrict->name ?? '') }}">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {

            // Saat pilih provinsi
            $('#province').on('change', function() {
                let provinceId = $(this).val();
                let provinceName = $(this).find(':selected').data('name');
                $('input[name="province_name"]').val(provinceName);

                $('#city').empty().append('<option value="">-- Pilih Kota/Kabupaten --</option>');
                $('#subdistrict').empty().append('<option value="">-- Pilih Kecamatan --</option>');

                if (provinceId) {
                    $.ajax({
                        url: `/cities/${provinceId}`,
                        type: "GET",
                        dataType: "json",
                        success: function(response) {
                            $.each(response, function(index, value) {
                                $('#city').append(
                                    `<option value="${value.id}" data-name="${value.name}">${value.name}</option>`
                                );
                            });
                        }
                    });
                }
            });

            // Saat pilih kota
            $('#city').on('change', function() {
                let cityId = $(this).val();
                let cityName = $(this).find(':selected').data('name');
                $('input[name="city_name"]').val(cityName);

                $('#subdistrict').empty().append('<option value="">-- Pilih Kecamatan --</option>');

                if (cityId) {
                    $.ajax({
                        url: `/districts/${cityId}`,
                        type: "GET",
                        dataType: "json",
                        success: function(response) {
                            $.each(response, function(index, value) {
                                $('#subdistrict').append(
                                    `<option value="${value.id}" data-name="${value.name}">${value.name}</option>`
                                );
                            });
                        }
                    });
                }
            });

            // Saat pilih kecamatan
            $('#subdistrict').on('change', function() {
                let subdistrictName = $(this).find(':selected').data('name');
                $('input[name="subdistrict_name"]').val(subdistrictName);
            });

        });
    </script>

@endsection
