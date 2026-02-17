<?php
use App\Models\OrganizationDepartments;
use App\Models\OtherEmployeeDetails;
use App\Models\LeaveTypes;
use App\Models\OrganizationLocations;
use App\Models\OtherAdminDetails;
use App\Models\OtherHRManagerDetails;
use App\Models\OtherHODDetails;
use App\Models\OtherAuthoriserDetails;
use App\Models\User;
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

    /* Flatpickr Orange Theme Override */
    .flatpickr-day.selected,
    .flatpickr-day.selected:focus,
    .flatpickr-day.selected:hover,
    .flatpickr-day.prevMonthDay.selected,
    .flatpickr-day.nextMonthDay.selected,
    .flatpickr-day.today.selected {
        background: #FF5A1D !important;
        border-color: #FF5A1D !important;
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
                        <h4 class="mb-sm-0 dashboard-title">Salary Report</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Salary Report</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xl-12">
                    <div class="card card-theme shadow-none rounded-3 border-0" style="overflow: visible !important;">
                        <div class="card-header border-0 bg-white p-4">
                            <h4 class="card-title mb-0 dashboard-title">Salary Report</h4>
                        </div>

                        <div class="card-body p-4 pt-0" style="overflow: visible !important; min-height: 350px;">
                            <form action="" method="post" enctype="multipart/form-data">
                                @csrf

                                <div class="row mb-3">
                                    <!-- Department -->
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label text-[#556476] font-medium">Department</label>
                                            <div class="custom-select">
                                                <button type="button" class="select-button">
                                                    <span class="selected-value">Select Department</span>
                                                    <span class="arrow">
                                                        <i class="ri-arrow-down-s-line"></i>
                                                    </span>
                                                </button>
                                                <ul class="select-dropdown hidden">
                                                    @foreach($departments as $department)
                                                        @php
                                                            $location_name = \App\Models\OrganizationLocations::where('id', $department->location)->value('location');
                                                        @endphp
                                                        <li data-value="{{ $department->id }}">
                                                            {{ $department->department }} ({{ $location_name }})
                                                        </li>
                                                    @endforeach
                                                </ul>
                                                <input type="hidden" name="department" value="">
                                            </div>
                                            @error('department')
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Start date -->
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label text-[#556476] font-medium">Year and Month (EG :
                                                2022-01)</label>
                                            <div class="position-relative">
                                                <input id="year_month" name="year_month" value="{{ old('year_month') }}"
                                                    type="text" class="form-control flatpickr-input active"
                                                    data-provider="flatpickr" data-date-format="Y-m"
                                                    readonly="readonly">
                                                <i class="ri-calendar-2-line position-absolute"
                                                    style="right: 12px; top: 12px; color: #556476; pointer-events: none;"></i>
                                            </div>
                                            @if($errors->has("year_month"))
                                                <div class="alert alert-danger mt-2">{{ $errors->first('year_month') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- End date -->
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label text-[#556476] font-medium">Download Format</label>
                                            <div class="custom-select">
                                                <button type="button" class="select-button">
                                                    <span class="selected-value">Select Format</span>
                                                    <span class="arrow">
                                                        <i class="ri-arrow-down-s-line"></i>
                                                    </span>
                                                </button>
                                                <ul class="select-dropdown hidden">
                                                    <li data-value="csv">CSV</li>
                                                    <li data-value="pdf">PDF</li>
                                                </ul>
                                                <input type="hidden" name="format" value="">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-12 text-end">
                                        <button type="submit" class="btn btn-theme-orange px-4 py-2">Download Salary
                                            Report</button>
                                    </div>
                                </div>

                                @if(Session::has('fail'))
                                    <div class="alert alert-danger mt-3">{{ Session::get('fail') }}</div>
                                @endif
                                @if(Session::has('success'))
                                    <div class="alert alert-success mt-3">{{ Session::get('success') }}</div>
                                @endif
                            </form>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
</div>
@include('layouts.footer')
<script src="{{ asset('assets/js/custom-dropdown.js') }}"></script>
<script>
    $(document).ready(function () {
        // Initialize Flatpickr for Year/Month
        flatpickr("#year_month", {
            dateFormat: "Y-m",
            disableMobile: "true"
        });
    });
</script>