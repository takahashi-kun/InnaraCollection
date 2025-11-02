@extends('layouts.master')
@section('title', 'Tentang Kita')
@section('content')
    <div class="page-content about-us">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="about-content">
                    <h1 class="text-center mb-5">Innara Collection – Toko Kaos Online Terpercaya dan Berkualitas</h1>

                    <div class="about-section mb-5">
                        <p class="lead">Innara Collection adalah toko online yang berfokus pada penjualan pakaian kaos berkualitas tinggi dengan desain modern dan nyaman digunakan untuk berbagai aktivitas. Kami hadir untuk memenuhi kebutuhan fashion sehari-hari masyarakat Indonesia yang ingin tampil stylish tanpa mengorbankan kenyamanan.</p>
                        
                        <p class="lead">Sebagai salah satu brand lokal yang berkembang pesat, Innara Collection senantiasa menghadirkan koleksi terbaru dengan berbagai pilihan model, warna, dan ukuran. Mulai dari kaos polos, kaos sablon, kaos oversized, hingga kaos couple, semuanya kami produksi dengan bahan pilihan yang lembut, adem, dan tahan lama.</p>
                        
                        <p class="lead">Kami percaya bahwa setiap orang berhak tampil percaya diri dengan gaya kasual yang sesuai kepribadian mereka. Karena itu, setiap produk kami dibuat dengan perhatian pada detail, mulai dari desain, kualitas jahitan, hingga kenyamanan bahan.</p>
                    </div>

                    <div class="feature-section mb-5">
                        <h2 class="section-title">Belanja Kaos Semudah di Genggaman</h2>
                        <p class="lead">Di Innara Collection, kamu bisa menikmati pengalaman berbelanja online yang mudah, cepat, dan aman. Hanya dengan beberapa klik, kamu sudah bisa mendapatkan kaos favoritmu tanpa perlu repot keluar rumah. Kami juga menyediakan berbagai metode pembayaran yang aman dan praktis, serta sistem pengiriman cepat ke seluruh wilayah Indonesia.</p>
                        
                        <p class="lead">Selain itu, kamu bisa mengikuti update produk terbaru kami melalui media sosial dan website resmi, agar tidak ketinggalan promo dan koleksi terbaru setiap minggunya. Dengan fitur "bagikan produk ke media sosial", kamu juga dapat menunjukkan gaya favoritmu ke teman-teman dan keluarga hanya dengan satu klik.</p>
                    </div>

                    <div class="promo-section">
                        <h2 class="section-title">Promo & Penawaran Spesial Tiap Bulan</h2>
                        <p class="lead">Kami tahu bahwa pelanggan setia pantas mendapatkan yang terbaik. Karena itu, Innara Collection selalu menghadirkan diskon menarik, cashback, dan promo spesial di setiap bulannya.</p>
                        
                        <p class="lead">Nikmati juga program flash sale, voucher potongan harga, dan penawaran terbatas untuk berbagai kategori kaos pilihan. Semakin sering kamu berbelanja, semakin banyak keuntungan yang bisa kamu dapatkan!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .about-us {
        padding: 60px 0;
        background-color: #f8f9fa;
    }

    .about-content {
        background: #fff;
        padding: 40px;
        margin-top: 61px;
        border-radius: 10px;
        box-shadow: 0 2px 15px rgba(0,0,0,0.1);
    }

    .about-content h1 {
        color: #333;
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 30px;
    }

    .section-title {
        color: #444;
        font-size: 1.8rem;
        font-weight: 600;
        margin-bottom: 20px;
    }

    .about-section, 
    .feature-section, 
    .promo-section {
        padding: 20px 0;
    }

    .about-content p {
        color: #666;
        line-height: 1.8;
        margin-bottom: 15px;
    }

    .about-content .lead {
        font-size: 1.2rem;
        color: #555;
        font-weight: 500;
    }

    @media (max-width: 768px) {
        .about-us {
            padding: 30px 0;
        }

        .about-content {
            padding: 20px;
        }

        .about-content h1 {
            font-size: 2rem;
        }

        .section-title {
            font-size: 1.5rem;
        }
    }
</style>
@endsection
@section('script')
  <script src="{{ asset ('build/assets/js/plugins/jquery.min.js') }}"></script>
  <script src="{{ asset ('build/assets/js/plugins/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset ('build/assets/js/plugins/bootstrap-slider.min.js') }}"></script>
  <script src="{{ asset ('build/assets/js/plugins/swiper.min.js') }}"></script>
  <script src="{{ asset ('build/assets/js/plugins/countdown.js') }}"></script>
  <script src="{{ asset ('build/assets/js/theme.js') }}"></script>
@endsection