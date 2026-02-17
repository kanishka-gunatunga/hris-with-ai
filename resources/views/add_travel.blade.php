<?php
use App\Models\OtherEmployeeDetails;
use App\Models\OrganizationLocations;
use App\Models\OrganizationDepartments;
?>
@include('layouts.header')
<link href="{{ asset('assets/css/custom-dropdown.css') }}" rel="stylesheet" type="text/css" />

<div class="main-content">

    <div class="page-content pb-10">
        <div class="container-fluid mb-10">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="mb-sm-0 dashboard-title">Add Travel</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Add Travel</li>
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
                                <h4 class="card-title mb-0 dashboard-title">Travel Details</h4>
                            </div>

                            <div class="card-body p-4 pt-0" style="overflow: visible !important; min-height: 450px;">
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
                                                            @if (old('employee'))
                                                                @foreach ($employees as $employee)
                                                                    @if ($employee->user_id == old('employee'))
                                                                        {{ $employee->first_name . ' ' . $employee->last_name }}
                                                                    @endif
                                                                @endforeach
                                                            @else
                                                                Select Employee
                                                            @endif
                                                        </span>
                                                        <span class="arrow">
                                                            <i class="ri-arrow-down-s-line"></i>
                                                        </span>
                                                    </button>
                                                    <ul class="select-dropdown hidden">
                                                        @foreach ($employees as $employee)
                                                            <li data-value="{{ $employee->user_id }}">
                                                                {{ $employee->first_name . ' ' . $employee->last_name }}
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                    <input type="hidden" name="employee" value="{{ old('employee') }}">
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
                                                <label class="form-label text-[#556476] font-medium">Arrangement
                                                    Type</label>
                                                <div class="custom-select">
                                                    <button type="button" class="select-button">
                                                        <span class="selected-value">
                                                            {{ old('arrangment_type') ?? 'Select Type' }}
                                                        </span>
                                                        <span class="arrow">
                                                            <i class="ri-arrow-down-s-line"></i>
                                                        </span>
                                                    </button>
                                                    <ul class="select-dropdown hidden">
                                                        <li data-value="1">Type 01</li>
                                                        <li data-value="2">Type 02</li>
                                                        <li data-value="3">Type 03</li>
                                                        <li data-value="4">Type 04</li>
                                                    </ul>
                                                    <input type="hidden" name="arrangment_type"
                                                        value="{{ old('arrangment_type') }}">
                                                </div>
                                                @if ($errors->has('arrangment_type'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('arrangment_type') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Purpose Of
                                                    Visit</label>
                                                <input type="text" class="form-control" name="visit_purpose"
                                                    value="{{ old('visit_purpose') }}">
                                                @if ($errors->has('visit_purpose'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('visit_purpose') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Place Of
                                                    Visit</label>
                                                <input type="text" class="form-control" name="visit_place"
                                                    value="{{ old('visit_place') }}">
                                                @if ($errors->has('visit_place'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('visit_place') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Start Date</label>
                                                <div class="position-relative">
                                                    <input name="start_date" value="{{ old('start_date') }}" type="text"
                                                        class="form-control flatpickr-input active"
                                                        data-provider="flatpickr" data-date-format="n/j/Y"
                                                        id="start_date" readonly="readonly">
                                                    <span
                                                        class="position-absolute top-50 end-0 translate-middle-y me-3 text-muted"
                                                        style="pointer-events: none;">
                                                        <i class="ri-calendar-2-line"></i>
                                                    </span>
                                                </div>
                                                @if ($errors->has('start_date'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('start_date') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">End Date</label>
                                                <div class="position-relative">
                                                    <input name="end_date" value="{{ old('end_date') }}" type="text"
                                                        class="form-control flatpickr-input active"
                                                        data-provider="flatpickr" data-date-format="n/j/Y" id="end_date"
                                                        readonly="readonly">
                                                    <span
                                                        class="position-absolute top-50 end-0 translate-middle-y me-3 text-muted"
                                                        style="pointer-events: none;">
                                                        <i class="ri-calendar-2-line"></i>
                                                    </span>
                                                </div>
                                                @if ($errors->has('end_date'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('end_date') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Expected
                                                    Budget</label>
                                                <input type="text" class="form-control" name="expected_budget"
                                                    value="{{ old('expected_budget') }}">
                                                @if ($errors->has('expected_budget'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('expected_budget') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Actual
                                                    Budget</label>
                                                <input type="text" class="form-control" name="actual_budget"
                                                    value="{{ old('actual_budget') }}">
                                                @if ($errors->has('actual_budget'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('actual_budget') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Travel
                                                    Mode</label>
                                                <div class="custom-select">
                                                    <button type="button" class="select-button">
                                                        <span class="selected-value">
                                                            {{ old('travel_mode') ?? 'Select Mode' }}
                                                        </span>
                                                        <span class="arrow">
                                                            <i class="ri-arrow-down-s-line"></i>
                                                        </span>
                                                    </button>
                                                    <ul class="select-dropdown hidden">
                                                        <li data-value="1">Mode 01</li>
                                                        <li data-value="2">Mode 02</li>
                                                        <li data-value="3">Mode 03</li>
                                                        <li data-value="4">Mode 04</li>
                                                    </ul>
                                                    <input type="hidden" name="travel_mode"
                                                        value="{{ old('travel_mode') }}">
                                                </div>
                                                @if ($errors->has('travel_mode'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('travel_mode') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Status</label>
                                                <div class="custom-select">
                                                    <button type="button" class="select-button">
                                                        <span class="selected-value">
                                                            {{ old('status') ?? 'Select Status' }}
                                                        </span>
                                                        <span class="arrow">
                                                            <i class="ri-arrow-down-s-line"></i>
                                                        </span>
                                                    </button>
                                                    <ul class="select-dropdown hidden">
                                                        <li data-value="1">Status 01</li>
                                                        <li data-value="2">Status 02</li>
                                                        <li data-value="3">Status 03</li>
                                                        <li data-value="4">Status 04</li>
                                                    </ul>
                                                    <input type="hidden" name="status" value="{{ old('status') }}">
                                                </div>
                                                @if ($errors->has('status'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('status') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Description</label>
                                                <textarea class="form-control"
                                                    name="discription">{{ old('discription') }}</textarea>
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
                                onclick="window.location.href='{{ url('core-hr-travels') }}'">Back</button>
                            <button type="submit" class="btn btn-theme-orange px-5 py-2">Save as Travel</button>
                        </div>

                        <style>
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
<script>
    flatpickr("#start_date", {
        dateFormat: "n/j/Y",
    });
    flatpickr("#end_date", {
        dateFormat: "n/j/Y",
    });
</script>