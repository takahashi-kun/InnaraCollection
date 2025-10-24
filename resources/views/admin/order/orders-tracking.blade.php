@extends('layouts.admin')
@section('title', 'Orders Tracking')
@section('content')
<div class="main-content">
    <div class="bottom-page">
        <div class="body-text">Copyright © 2024 SurfsideMedia</div>
    </div>
</div>
@endsection
@section('script')
    <script src="{{ asset('build/admin/assets/js/jquery.min.js')}}"></script>
    <script src="{{ asset('build/admin/assets/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('build/admin/assets/js/bootstrap-select.min.js')}}"></script>   
    <script src="{{ asset('build/admin/assets/js/apexcharts/apexcharts.js')}}"></script>
    <script src="{{ asset('build/admin/assets/js/main.js')}}"></script>
@endsection