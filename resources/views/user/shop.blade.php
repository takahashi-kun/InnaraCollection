@extends('layouts.master')
@section('title', 'Shop')
@section('content')
    <section class="product-single container">
        <div class="row">
            <div class="col-lg-7">
                <div class="product-single__media" data-media-type="vertical-thumbnail">
                    <div class="product-single__image">
                        <div class="swiper-container">
                            <div class="swiper-wrapper">
                                {{-- PERBAIKAN: Mengganti Merah-cabe.png menjadi PUTIH.png --}}
                                <div class="swiper-slide product-single__image-item">
                                    <img loading="lazy" class="h-auto"
                                        src="{{ asset('images/kaos/putih.png') }}" width="674"
                                        height="674" alt="Kaos Putih" />
                                    <a data-fancybox="gallery" href="../images/products/product_0.html"
                                        data-bs-toggle="tooltip" data-bs-placement="left" title="Zoom">
                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <use href="#icon_zoom" />
                                        </svg>
                                    </a>
                                </div>
                                <div class="swiper-slide product-single__image-item">
                                    <img loading="lazy" class="h-auto"
                                        src="{{ asset('images/kaos/putih.png') }}" width="674"
                                        height="674" alt="Detail Kaos Putih 1" />
                                    <a data-fancybox="gallery" href="../images/products/product_0.html"
                                        data-bs-toggle="tooltip" data-bs-placement="left" title="Zoom">
                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <use href="#icon_zoom" />
                                        </svg>
                                    </a>
                                </div>
                                <div class="swiper-slide product-single__image-item">
                                    <img loading="lazy" class="h-auto"
                                        src="{{ asset('images/kaos/putih.png') }}" width="674"
                                        height="674" alt="Detail Kaos Putih 2" />
                                    <a data-fancybox="gallery" href="../images/products/product_0.html"
                                        data-bs-toggle=\"tooltip\" data-bs-placement=\"left\" title=\"Zoom\">
                                        <svg width=\"16\" height=\"16\" viewBox=\"0 0 16 16\" fill=\"none\"
                                            xmlns=\"http://www.w3.org/2000/svg\">
                                            <use href=\"#icon_zoom\" />
                                        </svg>
                                    </a>
                                </div>
                                <div class="swiper-slide product-single__image-item">
                                    <img loading="lazy" class="h-auto"
                                        src="{{ asset('images/kaos/putih.png') }}" width="674"
                                        height="674" alt="Detail Kaos Putih 3" />
                                    <a data-fancybox="gallery" href="../images/products/product_0.html"
                                        data-bs-toggle=\"tooltip\" data-bs-placement=\"left\" title=\"Zoom\">
                                        <svg width=\"16\" height=\"16\" viewBox=\"0 0 16 16\" fill=\"none\"
                                            xmlns=\"http://www.w3.org/2000/svg\">
                                            <use href=\"#icon_zoom\" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                            <div class="swiper-pagination"></div>
                        </div>
                    </div>

                    <div class="product-single__thumbs">
                        <div class="swiper-container">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide product-single__thumbs-item">
                                    <img loading="lazy" class="h-auto"
                                        src="{{ asset('images/kaos/putih.png') }}" width="110"
                                        height="110" alt="Kaos Putih Thumbnail" />
                                </div>
                                <div class="swiper-slide product-single__thumbs-item">
                                    <img loading="lazy" class="h-auto"
                                        src="{{ asset('images/kaos/putih.png') }}" width="110"
                                        height="110" alt="Detail Kaos Putih 1 Thumbnail" />
                                </div>
                                <div class="swiper-slide product-single__thumbs-item">
                                    <img loading="lazy" class="h-auto"
                                        src="{{ asset('images/kaos/putih.png') }}" width="110"
                                        height="110" alt="Detail Kaos Putih 2 Thumbnail" />
                                </div>
                                <div class="swiper-slide product-single__thumbs-item">
                                    <img loading="lazy" class="h-auto"
                                        src="{{ asset('images/kaos/putih.png') }}" width="110"
                                        height="110" alt="Detail Kaos Putih 3 Thumbnail" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="product-single__info">
                    <h1 class="product-single__name">
                        <a href="#">Kaos Basic Putih</a>
                    </h1>
                    <div class="product-single__rating">
                        <div class="reviews-rating">
                            <svg width="17" height="16" viewBox="0 0 17 16" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <use href="#icon_star" />
                            </svg>
                            <svg width="17" height="16" viewBox="0 0 17 16" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <use href="#icon_star" />
                            </svg>
                            <svg width="17" height="16" viewBox="0 0 17 16" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <use href="#icon_star" />
                            </svg>
                            <svg width="17" height="16" viewBox="0 0 17 16" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <use href="#icon_star" />
                            </svg>
                            <svg width="17" height="16" viewBox="0 0 17 16" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <use href="#icon_star" />
                            </svg>
                        </div>
                        <span class="reviews-note text-lowercase text-secondary ms-1">8k+ reviews</span>
                    </div>
                    <div class="product-single__price">
                        <span class="current-price">$449</span>
                    </div>
                    <div class="product-single__short-desc">
                        <p>Phasellus sed volutpat orci. Fusce eget lore mauris vehicula elementum gravida nec dui. Aenean
                            aliquam
                            varius ipsum, non ultricies tellus sodales eu. Donec dignissim viverra nunc, ut aliquet magna
                            posuere
                            eget.</p>
                    </div>
                    <div class="product-single__meta-info">
                        <div class="meta-item">
                            <label>SKU:</label>
                            <span>N/A</span>
                        </div>
                        <div class="meta-item">
                            <label>Categories:</label>
                            <span>Casual & Urban Wear, Jackets, Men</span>
                        </div>
                        <div class="meta-item">
                            <label>Tags:</label>
                            <span>biker, black, bomber, leather</span>
                        </div>
                    </div>
                        <a href="{{ route('configurator') }}" class="btn btn-primary ">Desain Kaos Mu</a>
                </div>
            </div>
        </div>
    </section>
@endsection
