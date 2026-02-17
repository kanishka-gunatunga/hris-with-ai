<?php
foreach ($account_details as $account_detail) {

    $account_name = $account_detail->account_name;
    $initial_balance = $account_detail->initial_balance;
    $account_number = $account_detail->account_number;
    $branch_code = $account_detail->branch_code;
    $branch_name = $account_detail->branch_name;
    $swift_code = $account_detail->swift_code;
}

?>
@include('layouts.header')
<link href="{{ asset('assets/css/custom-dropdown.css') }}" rel="stylesheet" type="text/css" />
<style>
    .card-theme {
        box-shadow: none !important;
        border: none !important;
    }

    .dashboard-title {
        color: #1F2937 !important;
        font-weight: 600 !important;
    }

    .page-title-box {
        display: block !important;
        padding-bottom: 20px;
    }

    .page-title-right {
        float: none !important;
        margin-top: 5px;
    }

    .breadcrumb-item.active {
        color: #FF5A1D !important;
    }

    .btn-theme-orange {
        background-color: #FF5A1D !important;
        border-color: #FF5A1D !important;
        color: white !important;
    }

    .btn-theme-orange:hover {
        background-color: #E64A12 !important;
        border-color: #E64A12 !important;
    }

    .action-btn-back:hover {
        background-color: #FF5A1D !important;
        border-color: #FF5A1D !important;
        color: white !important;
    }

    @media (max-width: 991.98px) {
        .fixed-bottom {
            margin-left: 0 !important;
        }
    }
</style>

<div class="main-content">
    <div class="page-content pb-10">
        <div class="container-fluid mb-10">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="mb-sm-0 dashboard-title">Edit Account</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Edit Account</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xxl-12">
                    <form action="" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card card-theme shadow-none rounded-3 border-0">
                            <div class="card-header border-0 bg-white p-4">
                                <h4 class="card-title mb-0 dashboard-title">Account Details</h4>
                            </div>

                            <div class="card-body p-4 pt-0" style="min-height: 300px;">
                                @if (Session::has('success'))
                                    <div class="alert alert-success mt-2 mb-4">{{ Session::get('success') }}</div>
                                @endif

                                <div class="live-preview">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Account
                                                    Name</label>
                                                <input type="text" class="form-control" name="account_name"
                                                    value="{{ $account_name }}">
                                                @if ($errors->has('account_name'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('account_name') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Initial
                                                    Balance</label>
                                                <input type="text" class="form-control" name="initial_balance"
                                                    value="{{ $initial_balance }}">
                                                @if ($errors->has('initial_balance'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('initial_balance') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Account
                                                    Number</label>
                                                <input type="text" class="form-control" name="account_number"
                                                    value="{{ $account_number }}">
                                                @if ($errors->has('account_number'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('account_number') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Branch Code</label>
                                                <input type="text" class="form-control" name="branch_code"
                                                    value="{{ $branch_code }}">
                                                @if ($errors->has('branch_code'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('branch_code') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Branch Name</label>
                                                <input type="text" class="form-control" name="branch_name"
                                                    value="{{ $branch_name }}">
                                                @if ($errors->has('branch_name'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('branch_name') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">SWIFT Code</label>
                                                <input type="text" class="form-control" name="swift_code"
                                                    value="{{ $swift_code }}">
                                                @if ($errors->has('swift_code'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('swift_code') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <!--end row-->
                                </div>
                            </div>
                        </div> <!-- end card -->

                        <div class="fixed-bottom bg-white border-top p-3 d-flex justify-content-between align-items-center"
                            style="z-index: 1001; margin-left: 250px;">
                            <a href="{{ url('finance-account-list') }}"
                                class="btn btn-outline-secondary px-4 py-2 action-btn-back"
                                style="color: #556476; border-color: #556476;">Back</a>
                            <button type="submit" class="btn btn-theme-orange px-5 py-2">Save Account</button>
                        </div>
                    </form>
                </div> <!-- end col -->
            </div>
        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
</div>
@include('layouts.footer')
<script src="{{ asset('assets/js/custom-dropdown.js') }}"></script>