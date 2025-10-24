@extends('layouts.admin')
@section('title', 'All Users')
@section('content')
<div class="main-content">

    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>Users</h3>
                <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                    <li>
                        <a href="index.html">
                            <div class="text-tiny">Dashboard</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <div class="text-tiny">All User</div>
                    </li>
                </ul>
            </div>

            <div class="wg-box">
                <div class="flex items-center justify-between gap10 flex-wrap">
                    <div class="wg-filter flex-grow">
                        <form class="form-search">
                            <fieldset class="name">
                                <input type="text" placeholder="Search here..." class="" name="name"
                                    tabindex="2" value="" aria-required="true" required="">
                            </fieldset>
                            <div class="button-submit">
                                <button class="" type="submit"><i class="icon-search"></i></button>
                            </div>
                        </form>
                    </div>

                </div>
                <div class="wg-table table-all-user">

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>User</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th class="text-center">Total Orders</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td class="pname">
                                        <div class="image">
                                            <img src="user-1.html" alt="" class="image">
                                        </div>
                                        <div class="name">
                                            <a href="#" class="body-title-2">Admin</a>
                                            <div class="text-tiny mt-3">ADM</div>
                                        </div>
                                    </td>
                                    <td>1234567890</td>
                                    <td>admin@surfsidemedia.in</td>
                                    <td class="text-center"><a href="#" target="_blank">0</a></td>
                                    <td>
                                        <div class="list-icon-function">
                                            <a href="#">
                                                <div class="item edit">
                                                    <i class="icon-edit-3"></i>
                                                </div>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
                <div class="divider"></div>
                <div class="flex items-center justify-between flex-wrap gap10 wgp-pagination">

                </div>
            </div>
        </div>
    </div>

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