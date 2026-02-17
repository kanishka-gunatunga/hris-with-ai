<?php
foreach ($payee_details as $payee_detail) {

    $name = $payee_detail->name;
    $nic = $payee_detail->nic;
    $email = $payee_detail->email;
    $telephone = $payee_detail->telephone;
    $address = $payee_detail->address;
    $company_name = $payee_detail->company_name;
    $discription = $payee_detail->discription;
    $bank_name = $payee_detail->bank_name;
    $branch = $payee_detail->branch;
    $account_no = $payee_detail->account_no;
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
                        <h4 class="mb-sm-0 dashboard-title">Edit Payee</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Edit Payee</li>
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
                                <h4 class="card-title mb-0 dashboard-title">Payee Details</h4>
                            </div>

                            <div class="card-body p-4 pt-0" style="min-height: 300px;">
                                @if (Session::has('success'))
                                    <div class="alert alert-success mt-2 mb-4">{{ Session::get('success') }}</div>
                                @endif

                                <div class="live-preview">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Name</label>
                                                <input type="text" class="form-control" name="name" value="{{ $name }}">
                                                @if ($errors->has('name'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('name') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">NIC</label>
                                                <input type="text" class="form-control" name="nic" value="{{ $nic }}">
                                                @if ($errors->has('nic'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('nic') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Email</label>
                                                <input type="email" class="form-control" name="email"
                                                    value="{{ $email }}">
                                                @if ($errors->has('email'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('email') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Telephone</label>
                                                <input type="text" class="form-control" name="telephone"
                                                    value="{{ $telephone }}">
                                                @if ($errors->has('telephone'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('telephone') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Address</label>
                                                <input type="text" class="form-control" name="address"
                                                    value="{{ $address }}">
                                                @if ($errors->has('address'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('address') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Bank Name</label>
                                                <input type="text" class="form-control" name="bank_name"
                                                    value="{{ $bank_name }}">
                                                @if ($errors->has('bank_name'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('bank_name') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Branch</label>
                                                <input type="text" class="form-control" name="branch"
                                                    value="{{ $branch }}">
                                                @if ($errors->has('branch'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('branch') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Account No</label>
                                                <input type="text" class="form-control" name="account_no"
                                                    value="{{ $account_no }}">
                                                @if ($errors->has('account_no'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('account_no') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Company
                                                    Name</label>
                                                <input type="text" class="form-control" name="company_name"
                                                    value="{{ $company_name }}">
                                                @if ($errors->has('company_name'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('company_name') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Description</label>
                                                <textarea class="form-control"
                                                    name="discription">{{ $discription }}</textarea>
                                                @if ($errors->has('discription'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('discription') }}
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
                            <a href="{{ url('finance-payee') }}"
                                class="btn btn-outline-secondary px-4 py-2 action-btn-back"
                                style="color: #556476; border-color: #556476;">Back</a>
                            <button type="submit" class="btn btn-theme-orange px-5 py-2">Save Payee</button>
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