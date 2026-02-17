<?php
use App\Models\TrainingTrainers;
use App\Models\TrainingType;
use App\Models\TrainingListEmployees;
use App\Models\OtherEmployeeDetails;

?>
@include('layouts.header')
<link href="{{ asset('assets/css/custom-dropdown.css') }}" rel="stylesheet" type="text/css" />

<div class="main-content">

    <div class="page-content pb-5">
        <div class="container-fluid mb-5">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="mb-sm-0 dashboard-title">Add Training List</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Add Training List</li>
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
                                <h4 class="card-title mb-0 dashboard-title">Add Training List</h4>
                            </div>

                            <div class="card-body p-4 pt-0" style="overflow: visible !important; min-height: 400px;">
                                @if (Session::has('success'))
                                    <div class="alert alert-success mt-2 mb-4">{{ Session::get('success') }}</div>
                                @endif

                                <div class="live-preview">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Training
                                                    Type</label>
                                                <div class="custom-select">
                                                    <button type="button" class="select-button">
                                                        <span class="selected-value">Select Training Type</span>
                                                        <span class="arrow">
                                                            <i class="ri-arrow-down-s-line"></i>
                                                        </span>
                                                    </button>
                                                    <ul class="select-dropdown hidden">
                                                        <?php foreach ($training_types as $training_type) { ?>
                                                        <li data-value="{{ $training_type->id }}">
                                                            {{ $training_type->training_type }}
                                                        </li>
                                                        <?php } ?>
                                                    </ul>
                                                    <input type="hidden" name="training_type"
                                                        value="{{ old('training_type') }}">
                                                </div>
                                                @if ($errors->has('training_type'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('training_type') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Trainer</label>
                                                <div class="custom-select">
                                                    <button type="button" class="select-button">
                                                        <span class="selected-value">Select Trainer</span>
                                                        <span class="arrow">
                                                            <i class="ri-arrow-down-s-line"></i>
                                                        </span>
                                                    </button>
                                                    <ul class="select-dropdown hidden">
                                                        <?php foreach ($trainers as $trainer) { ?>
                                                        <li data-value="{{ $trainer->id }}">
                                                            {{ $trainer->first_name . ' ' . $trainer->last_name }}
                                                        </li>
                                                        <?php } ?>
                                                    </ul>
                                                    <input type="hidden" name="trainer" value="{{ old('trainer') }}">
                                                </div>
                                                @if ($errors->has('trainer'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('trainer') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="employees_select"
                                                    class="form-label text-[#556476] font-medium">Employees</label>
                                                <select class="form-control" name="employees[]" id="employees_select"
                                                    multiple>
                                                    @foreach ($employees as $employee)
                                                        <option value="{{ $employee->user_id }}">
                                                            {{ $employee->first_name . ' ' . $employee->last_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('employees'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('employees') }}
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
                                                        id="start_date">
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
                                                        data-provider="flatpickr" data-date-format="n/j/Y"
                                                        id="end_date">
                                                    <span
                                                        class="position-absolute top-50 end-0 translate-middle-y me-3 text-muted"
                                                        style="pointer-events: none;">
                                                        <i class="ri-calendar-2-line"></i>
                                                    </span>
                                                </div>
                                                @if ($errors->has('end_date'))
                                                    <div class="alert alert-danger mt-2">{{ $errors->first('end_date') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Training
                                                    Cost</label>
                                                <input type="text" class="form-control" name="training_cost"
                                                    value="{{ old('training_cost') }}">
                                                @if ($errors->has('training_cost'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('training_cost') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-12">
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
                                onclick="window.location.href='{{ url('training-list') }}'">Back</button>
                            <button type="submit" class="btn btn-theme-orange px-5 py-2">Save Training List</button>
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

                            /* Custom Orange Theme for Choices.js */
                            .choices__inner:focus,
                            .choices__inner:active {
                                border-color: #FF5A1D !important;
                            }

                            .choices__list--dropdown .choices__item--selectable.is-highlighted {
                                background-color: #FF5A1D !important;
                                color: white !important;
                            }

                            .choices__list--multiple .choices__item {
                                background-color: #FF5A1D !important;
                                border: 1px solid #FF5A1D !important;
                            }

                            .choices__list--dropdown {
                                z-index: 9999 !important;
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
    document.addEventListener('DOMContentLoaded', function () {
        var element = document.getElementById('employees_select');
        if (element) {
            new Choices(element, {
                removeItemButton: true
            });
        }
    });

    flatpickr("#start_date", {
        dateFormat: "n/j/Y",
    });
    flatpickr("#end_date", {
        dateFormat: "n/j/Y",
    });
</script>