<?php
use App\Models\TrainingTrainers;
use App\Models\TrainingType;
use App\Models\TrainingListEmployees;
use App\Models\OtherEmployeeDetails;
foreach ($list_details as $list_detail) {
    $training_type = $list_detail->training_type;
    $trainer = $list_detail->trainer;
    $start_date = $list_detail->start_date;
    $end_date = $list_detail->end_date;
    $training_cost = $list_detail->training_cost;
    $discription = $list_detail->discription;

    $training_type_name = TrainingType::where('id', $training_type)->value('training_type');
    $trainer_name = TrainingTrainers::where('id', $trainer)->value('first_name') . ' ' . TrainingTrainers::where('id', $trainer)->value('last_name');

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

<div class="main-content">
    <div class="page-content pb-10">
        <div class="container-fluid mb-10">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="mb-sm-0 dashboard-title">Edit Training List</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Edit Training List</li>
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
                                <h4 class="card-title mb-0 dashboard-title">Training List Details</h4>
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
                                                        <span class="selected-value">{{ $training_type_name }}</span>
                                                        <span class="arrow">
                                                            <i class="ri-arrow-down-s-line"></i>
                                                        </span>
                                                    </button>
                                                    <ul class="select-dropdown hidden">
                                                        @foreach ($training_types as $type)
                                                            <li data-value="{{ $type->id }}">{{ $type->training_type }}</li>
                                                        @endforeach
                                                    </ul>
                                                    <input type="hidden" name="training_type"
                                                        value="{{ $training_type }}">
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
                                                        <span class="selected-value">{{ $trainer_name }}</span>
                                                        <span class="arrow">
                                                            <i class="ri-arrow-down-s-line"></i>
                                                        </span>
                                                    </button>
                                                    <ul class="select-dropdown hidden">
                                                        @foreach ($trainers as $t)
                                                            <li data-value="{{ $t->id }}">
                                                                {{ $t->first_name . ' ' . $t->last_name }}</li>
                                                        @endforeach
                                                    </ul>
                                                    <input type="hidden" name="trainer" value="{{ $trainer }}">
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
                                                    @foreach ($list_employees as $list_employee)
                                                        <option value="{{ $list_employee->employee_id }}" selected>
                                                            {{ OtherEmployeeDetails::where('user_id', $list_employee->employee_id)->value('first_name') . ' ' . OtherEmployeeDetails::where('user_id', $list_employee->employee_id)->value('last_name') }}
                                                        </option>
                                                    @endforeach
                                                    @foreach ($employees as $employee)
                                                        @php
                                                            $isSelected = false;
                                                            foreach ($list_employees as $le) {
                                                                if ($le->employee_id == $employee->user_id) {
                                                                    $isSelected = true;
                                                                    break;
                                                                }
                                                            }
                                                        @endphp
                                                        @if (!$isSelected)
                                                            <option value="{{ $employee->user_id }}">
                                                                {{ $employee->first_name . ' ' . $employee->last_name }}
                                                            </option>
                                                        @endif
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
                                                    <input id="start_date" name="start_date" value="{{ $start_date }}"
                                                        type="text" class="form-control flatpickr-input active"
                                                        data-provider="flatpickr" data-date-format="n/j/Y"
                                                        readonly="readonly">
                                                    <i class="ri-calendar-2-line position-absolute"
                                                        style="right: 12px; top: 12px; color: #556476; pointer-events: none;"></i>
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
                                                    <input id="end_date" name="end_date" value="{{ $end_date }}"
                                                        type="text" class="form-control flatpickr-input active"
                                                        data-provider="flatpickr" data-date-format="n/j/Y"
                                                        readonly="readonly">
                                                    <i class="ri-calendar-2-line position-absolute"
                                                        style="right: 12px; top: 12px; color: #556476; pointer-events: none;"></i>
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
                                                <label class="form-label text-[#556476] font-medium">Training
                                                    Cost</label>
                                                <input type="text" class="form-control" name="training_cost"
                                                    value="{{ $training_cost }}">
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
                                                <textarea id="discription_editor" class="form-control"
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
                            <a href="{{ url('training-list') }}"
                                class="btn btn-outline-secondary px-4 py-2 action-btn-back"
                                style="color: #556476; border-color: #556476;">Back</a>
                            <button type="submit" class="btn btn-theme-orange px-5 py-2">Save Training List</button>
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
<script>
    $(document).ready(function () {
        // Initialize Choices.js
        var element = document.getElementById('employees_select');
        if (element) {
            new Choices(element, {
                removeItemButton: true
            });
        }

        // Initialize Flatpickr
        flatpickr("#start_date", {
            dateFormat: "n/j/Y",
            disableMobile: "true"
        });
        flatpickr("#end_date", {
            dateFormat: "n/j/Y",
            disableMobile: "true"
        });

        // Initialize Summernote
        $('#discription_editor').summernote({
            tabsize: 2,
            height: 200,
            callbacks: {
                onInit: function () {
                    $(this).next('.note-editor').addClass('card-theme rounded-3 border');
                    $(this).next('.note-editor').find('.note-toolbar').addClass('bg-light border-bottom');
                }
            }
        });
    });
</script>