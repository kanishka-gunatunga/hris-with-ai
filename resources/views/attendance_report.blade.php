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
                        <h4 class="mb-sm-0 dashboard-title">Attendance Report</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Attendance Report</li>
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
                            <h4 class="card-title mb-0 dashboard-title">Attendance Report</h4>
                        </div>
                        <div class="card-body p-4 pt-0" style="overflow: visible !important; min-height: 400px;">
                            <form action="" method="post" enctype="multipart/form-data">
                                @csrf

                                <div class="row mb-3">
                                    <!-- Select Employee -->
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label class="form-label text-[#556476] font-medium">Select Employee</label>
                                            <div class="custom-select">
                                                <button type="button" class="select-button">
                                                    <span class="selected-value">Select Employee</span>
                                                    <span class="arrow">
                                                        <i class="ri-arrow-down-s-line"></i>
                                                    </span>
                                                </button>
                                                <ul class="select-dropdown hidden">
                                                    @foreach($hrms as $hrm)
                                                        @php
                                                            $name = OtherHRManagerDetails::where('user_id', $hrm->id)->value('first_name') . ' ' . OtherHRManagerDetails::where('user_id', $hrm->id)->value('last_name');
                                                            $department = OtherHRManagerDetails::where('user_id', $hrm->id)->value('department');
                                                            $department_name = OrganizationDepartments::where('id', $department)->value('department');
                                                        @endphp
                                                        <li data-value="{{$hrm->id}}">{{ $name }} ({{ $department_name }})
                                                        </li>
                                                    @endforeach

                                                    @foreach($employees as $employee)
                                                        @php
                                                            $name = OtherEmployeeDetails::where('user_id', $employee->id)->value('first_name') . ' ' . OtherEmployeeDetails::where('user_id', $employee->id)->value('last_name');
                                                            $department = OtherEmployeeDetails::where('user_id', $employee->id)->value('department');
                                                            $department_name = OrganizationDepartments::where('id', $department)->value('department');
                                                        @endphp
                                                        <li data-value="{{$employee->id}}">{{ $name }}
                                                            ({{ $department_name }})</li>
                                                    @endforeach

                                                    @foreach($hods as $hod)
                                                        @php
                                                            $name = OtherHODDetails::where('user_id', $hod->id)->value('name');
                                                            $department = OtherHODDetails::where('user_id', $hod->id)->value('department');
                                                            $department_name = OrganizationDepartments::where('id', $department)->value('department');
                                                        @endphp
                                                        <li data-value="{{$hod->id}}">{{ $name }} ({{ $department_name }})
                                                        </li>
                                                    @endforeach

                                                    @foreach($authorizers as $authorizer)
                                                        @php
                                                            $name = OtherAuthoriserDetails::where('user_id', $authorizer->id)->value('name');
                                                            $department = OtherAuthoriserDetails::where('user_id', $authorizer->id)->value('department');
                                                            $department_name = OrganizationDepartments::where('id', $department)->value('department');
                                                        @endphp
                                                        <li data-value="{{$authorizer->id}}">{{ $name }}
                                                            ({{ $department_name }})</li>
                                                    @endforeach
                                                </ul>
                                                <input type="hidden" name="employee" id="employee" value="">
                                            </div>
                                            @if($errors->has("employee"))
                                                <div class="alert alert-danger mt-2">{{ $errors->first('employee') }}</div>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Start date -->
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label class="form-label text-[#556476] font-medium">Start Date</label>
                                            <div class="position-relative">
                                                <input id="start_date" name="start_date" type="text"
                                                    class="form-control flatpickr-input active"
                                                    data-provider="flatpickr" data-date-format="n/j/Y"
                                                    readonly="readonly" required>
                                                <i class="ri-calendar-2-line position-absolute"
                                                    style="right: 12px; top: 12px; color: #556476; pointer-events: none;"></i>
                                            </div>
                                            @error('start_date')
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- End date -->
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label class="form-label text-[#556476] font-medium">End Date</label>
                                            <div class="position-relative">
                                                <input id="end_date" name="end_date" type="text"
                                                    class="form-control flatpickr-input active"
                                                    data-provider="flatpickr" data-date-format="n/j/Y"
                                                    readonly="readonly" required>
                                                <i class="ri-calendar-2-line position-absolute"
                                                    style="right: 12px; top: 12px; color: #556476; pointer-events: none;"></i>
                                            </div>
                                            @error('end_date')
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label class="form-label text-[#556476] font-medium">Export Type</label>
                                            <div class="custom-select">
                                                <button type="button" class="select-button">
                                                    <span class="selected-value">Select Type</span>
                                                    <span class="arrow">
                                                        <i class="ri-arrow-down-s-line"></i>
                                                    </span>
                                                </button>
                                                <ul class="select-dropdown hidden">
                                                    <li data-value="csv">CSV</li>
                                                    <li data-value="pdf">PDF</li>
                                                </ul>
                                                <input type="hidden" name="export_type" value="">
                                            </div>
                                            @error('export_type')
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-12 text-end">
                                        <button type="submit" class="btn btn-theme-orange px-4 py-2">Download Attendance
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
        // Initialize Flatpickr
        flatpickr("#start_date", {
            dateFormat: "n/j/Y",
            disableMobile: "true"
        });
        flatpickr("#end_date", {
            dateFormat: "n/j/Y",
            disableMobile: "true"
        });
    });
</script>