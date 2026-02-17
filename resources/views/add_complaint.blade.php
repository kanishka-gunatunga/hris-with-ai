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
                        <h4 class="mb-sm-0 dashboard-title">Add Complaint</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Add Complaint</li>
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
                                <h4 class="card-title mb-0 dashboard-title">Complaint Details</h4>
                            </div>

                            <div class="card-body p-4 pt-0" style="overflow: visible !important; min-height: 350px;">
                                @if (Session::has('success'))
                                    <div class="alert alert-success mt-2 mb-4">{{ Session::get('success') }}</div>
                                @endif

                                <div class="live-preview">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Complaint
                                                    From</label>
                                                <div class="custom-select">
                                                    <button type="button" class="select-button">
                                                        <span class="selected-value">
                                                            @if (old('complaint_from'))
                                                                @foreach ($employees as $employee)
                                                                    @if ($employee->user_id == old('complaint_from'))
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
                                                    <input type="hidden" name="complaint_from"
                                                        value="{{ old('complaint_from') }}">
                                                </div>
                                                @if ($errors->has('complaint_from'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('complaint_from') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Complaint
                                                    Against</label>
                                                <div class="custom-select">
                                                    <button type="button" class="select-button">
                                                        <span class="selected-value">
                                                            @if (old('complaint_against'))
                                                                @foreach ($employees as $employee)
                                                                    @if ($employee->user_id == old('complaint_against'))
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
                                                    <input type="hidden" name="complaint_against"
                                                        value="{{ old('complaint_against') }}">
                                                </div>
                                                @if ($errors->has('complaint_against'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('complaint_against') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <!--end col-->

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Complaint
                                                    Title</label>
                                                <input type="text" class="form-control" name="complaint_title"
                                                    value="{{ old('complaint_title') }}">
                                                @if ($errors->has('complaint_title'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('complaint_title') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Complaint
                                                    Date</label>
                                                <div class="position-relative">
                                                    <input name="complaint_date" value="{{ old('complaint_date') }}"
                                                        type="text" class="form-control flatpickr-input active"
                                                        data-provider="flatpickr" data-date-format="n/j/Y"
                                                        id="complaint_date" readonly="readonly">
                                                    <span
                                                        class="position-absolute top-50 end-0 translate-middle-y me-3 text-muted"
                                                        style="pointer-events: none;">
                                                        <i class="ri-calendar-2-line"></i>
                                                    </span>
                                                </div>
                                                @if ($errors->has('complaint_date'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('complaint_date') }}
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
                                        <!--end col-->

                                        <div class="col-md-12">
                                            <div class="form-check mb-3">
                                                <input class="form-check-input orange-check" type="checkbox"
                                                    id="formCheck6" name="send_notification">
                                                <label class="form-check-label text-[#556476]" for="formCheck6">
                                                    Send Notification?
                                                </label>
                                            </div>
                                        </div>
                                        <!--end col-->
                                    </div>
                                    <!--end row-->
                                </div>
                            </div>
                        </div> <!-- end card -->

                        <div class="fixed-bottom bg-white border-top p-3 d-flex justify-content-between align-items-center"
                            style="z-index: 1001; margin-left: 250px;">
                            <button type="button" class="btn btn-outline-secondary px-4 py-2 action-btn-back"
                                style="color: #556476; border-color: #556476;"
                                onclick="window.location.href='{{ url('core-hr-complaints') }}'">Back</button>
                            <button type="submit" class="btn btn-theme-orange px-5 py-2">Save as Complaint</button>
                        </div>

                        <style>
                            .action-btn-back:hover {
                                background-color: #FF5A1D !important;
                                border-color: #FF5A1D !important;
                                color: white !important;
                            }

                            .orange-check:checked {
                                background-color: #FF5A1D !important;
                                border-color: #FF5A1D !important;
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
    flatpickr("#complaint_date", {
        dateFormat: "n/j/Y",
    });
</script>