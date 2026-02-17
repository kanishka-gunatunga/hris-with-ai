<?php
use App\Models\OtherEmployeeDetails;
use App\Models\OrganizationDepartments;
use App\Models\OrganizationLocations;
foreach ($transfer_details as $transfer_detail) {
    $employee = $transfer_detail->employee;
    $from_department = $transfer_detail->from_department;
    $to_department = $transfer_detail->to_department;
    $transfer_date = $transfer_detail->transfer_date;
    $discription = $transfer_detail->discription;
    $employee_name = OtherEmployeeDetails::where('user_id', $employee)->value('first_name') . ' ' . OtherEmployeeDetails::where('user_id', $employee)->value('last_name');
    $from_department_name = OrganizationDepartments::where('id', $from_department)->value('department');
    $from_department_location = OrganizationDepartments::where('id', $from_department)->value('location');
    $from_selected_location_name = OrganizationLocations::where('id', $from_department_location)->value('location');
    $to_department_name = OrganizationDepartments::where('id', $to_department)->value('department');
    $to_department_location = OrganizationDepartments::where('id', $to_department)->value('location');
    $to_selected_location_name = OrganizationLocations::where('id', $to_department_location)->value('location');
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

    /* Custom Orange Theme for Flatpickr */
    .flatpickr-day.selected,
    .flatpickr-day.startRange,
    .flatpickr-day.endRange,
    .flatpickr-day.selected.inRange,
    .flatpickr-day.startRange.inRange,
    .flatpickr-day.endRange.inRange,
    .flatpickr-day.selected:focus,
    .flatpickr-day.startRange:focus,
    .flatpickr-day.endRange:focus,
    .flatpickr-day.selected:hover,
    .flatpickr-day.startRange:hover,
    .flatpickr-day.endRange:hover,
    .flatpickr-day.selected.prevMonthDay,
    .flatpickr-day.startRange.prevMonthDay,
    .flatpickr-day.endRange.prevMonthDay,
    .flatpickr-day.selected.nextMonthDay,
    .flatpickr-day.startRange.nextMonthDay,
    .flatpickr-day.endRange.nextMonthDay {
        background: #FF5A1D !important;
        border-color: #FF5A1D !important;
    }

    .flatpickr-day.today {
        border-color: #FF5A1D !important;
    }

    .flatpickr-day.today:hover,
    .flatpickr-day.today:focus {
        border-color: #FF5A1D !important;
        background: #FF5A1D !important;
        color: white !important;
    }

    .flatpickr-calendar {
        z-index: 9999 !important;
    }
</style>
<div class="main-content">

    <div class="page-content pb-10">
        <div class="container-fluid mb-10">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="mb-sm-0 dashboard-title">Edit Transfer</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Edit Transfer</li>
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
                                <h4 class="card-title mb-0 dashboard-title">Transfer Details</h4>
                            </div>

                            <div class="card-body p-4 pt-0" style="overflow: visible !important; min-height: 400px;">
                                @if (Session::has('success'))
                                    <div class="alert alert-success mt-2 mb-4">{{ Session::get('success') }}</div>
                                @endif
                                <div class="live-preview">

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Employee</label>
                                                <div class="custom-select">
                                                    <button type="button" class="select-button">
                                                        <span class="selected-value">
                                                            {{ $employee_name }}
                                                        </span>
                                                        <span class="arrow">
                                                            <i class="ri-arrow-down-s-line"></i>
                                                        </span>
                                                    </button>
                                                    <ul class="select-dropdown hidden">
                                                        @foreach ($employees as $emp)
                                                            <li data-value="{{ $emp->user_id }}">
                                                                {{ $emp->first_name . ' ' . $emp->last_name }}
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
                                                <label class="form-label text-[#556476] font-medium">From
                                                    Department</label>
                                                <div class="custom-select">
                                                    <button type="button" class="select-button">
                                                        <span class="selected-value">
                                                            {{ $from_department_name . ' (' . $from_selected_location_name . ')' }}
                                                        </span>
                                                        <span class="arrow">
                                                            <i class="ri-arrow-down-s-line"></i>
                                                        </span>
                                                    </button>
                                                    <ul class="select-dropdown hidden">
                                                        @foreach ($depatments as $dep)
                                                            <?php    $loc_name = OrganizationLocations::where('id', $dep->location)->value('location'); ?>
                                                            <li data-value="{{ $dep->id }}">
                                                                {{ $dep->department . ' (' . $loc_name . ')' }}
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                    <input type="hidden" name="from_department"
                                                        value="{{ $from_department }}">
                                                </div>
                                                @if ($errors->has('from_department'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('from_department') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">To
                                                    Department</label>
                                                <div class="custom-select">
                                                    <button type="button" class="select-button">
                                                        <span class="selected-value">
                                                            {{ $to_department_name . ' (' . $to_selected_location_name . ')' }}
                                                        </span>
                                                        <span class="arrow">
                                                            <i class="ri-arrow-down-s-line"></i>
                                                        </span>
                                                    </button>
                                                    <ul class="select-dropdown hidden">
                                                        @foreach ($depatments as $dep)
                                                            <?php    $loc_name = OrganizationLocations::where('id', $dep->location)->value('location'); ?>
                                                            <li data-value="{{ $dep->id }}">
                                                                {{ $dep->department . ' (' . $loc_name . ')' }}
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                    <input type="hidden" name="to_department"
                                                        value="{{ $to_department }}">
                                                </div>
                                                @if ($errors->has('to_department'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('to_department') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Transfer
                                                    Date</label>
                                                <div class="position-relative">
                                                    <input name="transfer_date" value="{{ $transfer_date }}" type="text"
                                                        class="form-control flatpickr-input active"
                                                        data-provider="flatpickr" data-date-format="n/j/Y"
                                                        id="transfer_date" readonly="readonly">
                                                    <span
                                                        class="position-absolute top-50 end-0 translate-middle-y me-3 text-muted"
                                                        style="pointer-events: none;">
                                                        <i class="ri-calendar-2-line"></i>
                                                    </span>
                                                </div>
                                                @if ($errors->has('transfer_date'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('transfer_date') }}
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
                            <button type="button" class="btn btn-outline-secondary px-4 py-2 action-btn-back"
                                style="color: #556476; border-color: #556476;"
                                onclick="window.location.href='{{ url('core-hr-transfers') }}'">Back</button>
                            <button type="submit" class="btn btn-theme-orange px-5 py-2">Save Transfer</button>
                        </div>
                    </form>
                </div>

            </div>



        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
    @include('layouts.footer')
    <script src="{{ asset('assets/js/custom-dropdown.js') }}"></script>
    <script>
        flatpickr("#transfer_date", {
            dateFormat: "n/j/Y",
        });
    </script>