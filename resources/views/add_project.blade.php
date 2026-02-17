<?php
use App\Models\OtherEmployeeDetails;
use App\Models\OtherClientDetails;

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
                        <h4 class="mb-sm-0 dashboard-title">Add Project</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Add Project</li>
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
                                <h4 class="card-title mb-0 dashboard-title">Project Details</h4>
                            </div>

                            <div class="card-body p-4 pt-0" style="overflow: visible !important; min-height: 400px;">
                                @if (Session::has('success'))
                                    <div class="alert alert-success mt-2 mb-4">{{ Session::get('success') }}</div>
                                @endif

                                <div class="live-preview">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Title</label>
                                                <input type="text" class="form-control" name="title"
                                                    value="{{ old('title') }}">
                                                @if ($errors->has('title'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('title') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Client</label>
                                                <div class="custom-select">
                                                    <button type="button" class="select-button">
                                                        <span class="selected-value">
                                                            @if (old('client'))
                                                                @foreach ($clients as $client)
                                                                    @if ($client->user_id == old('client'))
                                                                        {{ $client->first_name . ' ' . $client->last_name }}
                                                                    @endif
                                                                @endforeach
                                                            @else
                                                                Select Client
                                                            @endif
                                                        </span>
                                                        <span class="arrow">
                                                            <i class="ri-arrow-down-s-line"></i>
                                                        </span>
                                                    </button>
                                                    <ul class="select-dropdown hidden">
                                                        @foreach ($clients as $client)
                                                            <li data-value="{{ $client->user_id }}">
                                                                {{ $client->first_name . ' ' . $client->last_name }}
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                    <input type="hidden" name="client" value="{{ old('client') }}">
                                                </div>
                                                @if ($errors->has('client'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('client') }}
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
                                                <label class="form-label text-[#556476] font-medium">Priority</label>
                                                <div class="custom-select">
                                                    <button type="button" class="select-button">
                                                        <span class="selected-value">
                                                            {{ old('priority') ?? 'Select Priority' }}
                                                        </span>
                                                        <span class="arrow">
                                                            <i class="ri-arrow-down-s-line"></i>
                                                        </span>
                                                    </button>
                                                    <ul class="select-dropdown hidden">
                                                        <li data-value="Low">Low</li>
                                                        <li data-value="Medium">Medium</li>
                                                        <li data-value="High">High</li>
                                                        <li data-value="Highest">Highest</li>
                                                    </ul>
                                                    <input type="hidden" name="priority" value="{{ old('priority') }}">
                                                </div>
                                                @if ($errors->has('priority'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('priority') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Company</label>
                                                <div class="custom-select">
                                                    <button type="button" class="select-button">
                                                        <span class="selected-value">
                                                            {{ old('company') ?? 'Select Company' }}
                                                        </span>
                                                        <span class="arrow">
                                                            <i class="ri-arrow-down-s-line"></i>
                                                        </span>
                                                    </button>
                                                    <ul class="select-dropdown hidden">
                                                        <li data-value="1">1</li>
                                                        <li data-value="2">2</li>
                                                        <li data-value="3">3</li>
                                                        <li data-value="4">4</li>
                                                    </ul>
                                                    <input type="hidden" name="company" value="{{ old('company') }}">
                                                </div>
                                                @if ($errors->has('company'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('company') }}
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
                                                <label class="form-label text-[#556476] font-medium">Summary</label>
                                                <textarea class="form-control"
                                                    name="summery">{{ old('summery') }}</textarea>
                                                @if ($errors->has('summery'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('summery') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Progress
                                                    (%)</label>
                                                <input type="text" class="form-control" name="progress"
                                                    value="{{ old('progress') }}">
                                                @if ($errors->has('progress'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('progress') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Description</label>
                                                <textarea class="form-control" id="discription"
                                                    name="discription"><?php echo old('discription'); ?></textarea>
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
                                onclick="window.location.href='{{ url('pm-projects') }}'">Back</button>
                            <button type="submit" class="btn btn-theme-orange px-5 py-2">Save Project</button>
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

                            /* Custom Orange Theme for Choices.js and Dropdowns */
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

    $('#discription').summernote({
        tabsize: 2,
        height: 200
    });
</script>