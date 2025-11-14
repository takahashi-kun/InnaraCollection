@extends('layouts.master')
@section('title', 'Contact Us')
@section('content')
    <div class="page-content contact-us">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="contact-content">
                        <h1 class="text-center mb-5">Hubungi Kami – Innara Collection</h1>

                        <div class="contact-section mb-5">
                            <p class="lead text-center">
                                Kami senang mendengar dari kamu! Jika kamu memiliki pertanyaan, saran, atau ingin bekerja
                                sama,
                                silakan hubungi kami melalui salah satu kontak di bawah ini atau isi formulir yang telah
                                kami
                                sediakan.
                            </p>
                        </div>

                        <!-- Informasi Kontak -->
                        <div class="row contact-info mb-5">
                            <div class="col-md-4 text-center mb-4">
                                <div class="contact-box">
                                    <div class="icon mb-3"><i class="fas fa-map-marker-alt"></i></div>
                                    <h5>Alamat Kantor</h5>
                                    <p>Jl. H. Aen Suhendra, Nanjung, Kec. Margaasih, Kabupaten Bandung, Jawa Barat, Indonesia</p>
                                </div>
                            </div>

                            <div class="col-md-4 text-center mb-4">
                                <div class="contact-box">
                                    <div class="icon mb-3"><i class="fas fa-phone"></i></div>
                                    <h5>Telepon</h5>
                                    <p>+62 812-3456-7890</p>
                                </div>
                            </div>

                            <div class="col-md-4 text-center mb-4">
                                <div class="contact-box">
                                    <div class="icon mb-3"><i class="fas fa-envelope"></i></div>
                                    <h5>Email</h5>
                                    <p>InnaraCollection@gmail.com</p>
                                </div>
                            </div>
                        </div>

                        <!-- Peta Lokasi -->
                        <div class="map-section">
                            <h2 class="section-title text-center mb-4">Lokasi Kami</h2>
                            <div class="map-container">
                                <iframe
                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.585365204335!2d107.53918999999999!3d-6.940055699999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68ef6fc6e58aed%3A0x1273859958d03977!2sJl.%20H.%20Aen%20Suhendra%2C%20Kec.%20Margaasih%2C%20Kabupaten%20Bandung%2C%20Jawa%20Barat%2040217!5e0!3m2!1sja!2sid!4v1763051189966!5m2!1sja!2sid"
                                    width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy">
                                </iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- === STYLE === -->
    <style>
        .contact-us {
            padding: 60px 0;
            background-color: #f8f9fa;
        }

        .contact-content {
            background: #fff;
            padding: 40px;
            margin-top: 61px;
            border-radius: 10px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
        }

        .contact-content h1 {
            color: #333;
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 30px;
        }

        .contact-section p.lead {
            color: #555;
            font-size: 1.2rem;
            line-height: 1.8;
        }

        .contact-box {
            background: #f9fafc;
            border-radius: 8px;
            padding: 25px 15px;
            box-shadow: 0 1px 6px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .contact-box:hover {
            transform: translateY(-3px);
            background: #f0f5ff;
        }

        .contact-box .icon i {
            font-size: 30px;
            color: #4e73df;
        }

        .contact-box h5 {
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
        }

        .contact-box p {
            color: #555;
            margin: 0;
        }

        .section-title {
            color: #444;
            font-size: 1.8rem;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .contact-form label {
            font-weight: 500;
            color: #555;
        }

        .contact-form .form-control {
            border-radius: 6px;
            border: 1px solid #ccc;
            transition: all 0.2s ease;
        }

        .contact-form .form-control:focus {
            border-color: #4e73df;
            box-shadow: 0 0 5px rgba(78, 115, 223, 0.2);
        }

        .btn-primary {
            background-color: #4e73df;
            border-color: #4e73df;
            border-radius: 6px;
            font-weight: 500;
        }

        .btn-primary:hover {
            background-color: #3b5dc9;
        }

        .map-container {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 1px 10px rgba(0, 0, 0, 0.1);
        }

        @media (max-width: 768px) {
            .contact-us {
                padding: 30px 0;
            }

            .contact-content {
                padding: 20px;
            }

            .contact-content h1 {
                font-size: 2rem;
            }

            .section-title {
                font-size: 1.5rem;
            }
        }
    </style>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />

@endsection
@section('script')
    <script src="{{ asset('build/assets/admin/js/plugins/jquery.min.js') }}"></script>
    <script src="{{ asset('build/assets/admin/js/plugins/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('build/assets/admin/js/plugins/bootstrap-slider.min.js') }}"></script>
    <script src="{{ asset('build/assets/admin/js/plugins/swiper.min.js') }}"></script>
    <script src="{{ asset('build/assets/admin/js/plugins/countdown.js') }}"></script>
    <script src="{{ asset('build/assets/admin/js/theme.js') }}"></script>
@endsection
