<?php
$first_name = $last_name = $company = $phone = $website = $address_line_1 = $address_line_2 = $city = $state_province = $zip = $country = '';
$email = $user_name = '';

foreach ($client_details as $client_detail) {
    $first_name = $client_detail->first_name;
    $last_name = $client_detail->last_name;
    $company = $client_detail->company;
    $phone = $client_detail->phone;
    $website = $client_detail->website;
    $address_line_1 = $client_detail->address_line_1;
    $address_line_2 = $client_detail->address_line_2;
    $city = $client_detail->city;
    $state_province = $client_detail->state_province;
    $zip = $client_detail->zip;
    $country = $client_detail->country;
}
foreach ($login_details as $login_detail) {
    $email = $login_detail->email;
    $user_name = $login_detail->user_name;
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

    /* Custom Orange Theme for Dropdowns */
    .select-dropdown {
        z-index: 1050 !important;
    }
</style>

<div class="main-content">
    <div class="page-content pb-10">
        <div class="container-fluid mb-10">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="mb-sm-0 dashboard-title">Edit Client</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Edit Client</li>
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
                        <div class="card card-theme shadow-none rounded-3 border-0"
                            style="overflow: visible !important;">
                            <div class="card-header border-0 bg-white p-4">
                                <h4 class="card-title mb-0 dashboard-title">Client Details</h4>
                            </div>

                            <div class="card-body p-4 pt-0" style="overflow: visible !important; min-height: 400px;">
                                @if (Session::has('success'))
                                    <div class="alert alert-success mt-2 mb-4">{{ Session::get('success') }}</div>
                                @endif

                                <div class="live-preview">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">First Name</label>
                                                <input type="text" class="form-control" name="first_name"
                                                    value="{{ $first_name }}">
                                                @if ($errors->has('first_name'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('first_name') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Last Name</label>
                                                <input type="text" class="form-control" name="last_name"
                                                    value="{{ $last_name }}">
                                                @if ($errors->has('last_name'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('last_name') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Company</label>
                                                <input type="text" class="form-control" name="company"
                                                    value="{{ $company }}">
                                                @if ($errors->has('company'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('company') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Username</label>
                                                <input type="text" class="form-control" name="user_name"
                                                    value="{{ $user_name }}">
                                                @if ($errors->has('user_name'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('user_name') }}
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
                                                <label class="form-label text-[#556476] font-medium">Password</label>
                                                <input type="password" class="form-control" name="password" value="">
                                                @if ($errors->has('password'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('password') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Phone</label>
                                                <input type="text" class="form-control" name="phone"
                                                    value="{{ $phone }}">
                                                @if ($errors->has('phone'))
                                                    <div class="alert alert-danger mt-2">{{ $errors->first('phone') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Website</label>
                                                <input type="text" class="form-control" name="website"
                                                    value="{{ $website }}">
                                                @if ($errors->has('website'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('website') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Address Line
                                                    1</label>
                                                <input type="text" class="form-control" name="address_line_1"
                                                    value="{{ $address_line_1 }}">
                                                @if ($errors->has('address_line_1'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('address_line_1') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Address Line
                                                    2</label>
                                                <input type="text" class="form-control" name="address_line_2"
                                                    value="{{ $address_line_2 }}">
                                                @if ($errors->has('address_line_2'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('address_line_2') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">City</label>
                                                <input type="text" class="form-control" name="city" value="{{ $city }}">
                                                @if ($errors->has('city'))
                                                    <div class="alert alert-danger mt-2">{{ $errors->first('city') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label
                                                    class="form-label text-[#556476] font-medium">State/Province</label>
                                                <input type="text" class="form-control" name="state_province"
                                                    value="{{ $state_province }}">
                                                @if ($errors->has('state_province'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('state_province') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Zip</label>
                                                <input type="text" class="form-control" name="zip" value="{{ $zip }}">
                                                @if ($errors->has('zip'))
                                                    <div class="alert alert-danger mt-2">{{ $errors->first('zip') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Country</label>
                                                <div class="custom-select">
                                                    <button type="button" class="select-button">
                                                        <span class="selected-value">
                                                            {{ $country ?? 'Select Country' }}
                                                        </span>
                                                        <span class="arrow">
                                                            <i class="ri-arrow-down-s-line"></i>
                                                        </span>
                                                    </button>
                                                    <ul class="select-dropdown hidden">
                                                        <li data-value="India">India</li>
                                                        <li data-value="USA">USA</li>
                                                        <li data-value="UK">UK</li>
                                                        <li data-value="Sri Lanka">Sri Lanka</li>
                                                        <li data-value="Australia">Australia</li>
                                                    </ul>
                                                    <input type="hidden" name="country" value="{{ $country }}">
                                                </div>
                                                @if ($errors->has('country'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('country') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Image</label>
                                                <input type="file" class="form-control" name="image">
                                                @if ($errors->has('image'))
                                                    <div class="alert alert-danger mt-2">{{ $errors->first('image') }}
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
                            <button type="button" class="btn btn-outline-secondary px-4 py-2 action-btn-back"
                                style="color: #556476; border-color: #556476;"
                                onclick="window.location.href='{{ url('pm-clients') }}'">Back</button>
                            <button type="submit" class="btn btn-theme-orange px-5 py-2">Save Client</button>
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