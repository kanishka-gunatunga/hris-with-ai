<?php
use App\Models\OtherEmployeeDetails;

$employee = $location = $address_line_1 = $address_line_2 = $city = $state = $country = $zip = $employee_name = '';

foreach ($location_details as $location_detail) {
    $employee = $location_detail->employee;
    $location = $location_detail->location;
    $address_line_1 = $location_detail->address_line_1;
    $address_line_2 = $location_detail->address_line_2;
    $city = $location_detail->city;
    $state = $location_detail->state;
    $country = $location_detail->country;
    $zip = $location_detail->zip;
    $employee_name = OtherEmployeeDetails::where('user_id', $employee)->value('first_name') . ' ' . OtherEmployeeDetails::where('user_id', $employee)->value('last_name');
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

    /* Custom Orange Theme for Choices.js and Dropdowns */
    .choices__list--dropdown .choices__item--selectable.is-highlighted {
        background-color: #FF5A1D !important;
    }

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
                        <h4 class="mb-sm-0 dashboard-title">Edit Location</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Edit Location</li>
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
                                <h4 class="card-title mb-0 dashboard-title">Location Details</h4>
                            </div>

                            <div class="card-body p-4 pt-0" style="overflow: visible !important; min-height: 400px;">
                                @if (Session::has('success'))
                                    <div class="alert alert-success mt-2 mb-4">{{ Session::get('success') }}</div>
                                @endif

                                <div class="live-preview">
                                    <div class="row">

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Location</label>
                                                <input type="text" class="form-control" name="location"
                                                    value="{{ $location }}">
                                                @if ($errors->has('location'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('location') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Location
                                                    Head</label>
                                                <div class="custom-select">
                                                    <button type="button" class="select-button">
                                                        <span class="selected-value">
                                                            {{ $employee_name ?: 'Select Location Head' }}
                                                        </span>
                                                        <span class="arrow">
                                                            <i class="ri-arrow-down-s-line"></i>
                                                        </span>
                                                    </button>
                                                    <ul class="select-dropdown hidden">
                                                        @foreach ($employees as $emp)
                                                            <li data-value="{{ $emp->user_id }}">
                                                                {{ $emp->name }}
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                    <input type="hidden" name="employee" value="{{ $employee }}">
                                                </div>
                                                @if ($errors->has('employee'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('employee') }}
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
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('city') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">State</label>
                                                <input type="text" class="form-control" name="state"
                                                    value="{{ $state }}">
                                                @if ($errors->has('state'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('state') }}
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
                                                            {{ $country ?: 'Select Country' }}
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
                                                <label class="form-label text-[#556476] font-medium">Zip</label>
                                                <input type="text" class="form-control" name="zip" value="{{ $zip }}">
                                                @if ($errors->has('zip'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('zip') }}
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
                                onclick="window.location.href='{{ url('organization-locations') }}'">Back</button>
                            <button type="submit" class="btn btn-theme-orange px-5 py-2">Save Location</button>
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