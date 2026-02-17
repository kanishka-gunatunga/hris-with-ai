<?php
use App\Models\OrganizationDepartments;
use App\Models\OrganizationLocations;

$title = $summery = $start_date = $end_date = $department = $discription = $notify = $department_name = $selected_location_name = $check = '';

foreach ($announcement_details as $announcement_detail) {
    $title = $announcement_detail->title;
    $summery = $announcement_detail->summery;
    $start_date = $announcement_detail->start_date;
    $end_date = $announcement_detail->end_date;
    $department = $announcement_detail->department;
    $discription = $announcement_detail->discription;
    $notify = $announcement_detail->notify;
    $check = ($notify == 'on') ? 'checked' : '';

    $department_name = OrganizationDepartments::where('id', $department)->value('department');
    $department_location = OrganizationDepartments::where('id', $department)->value('location');
    $selected_location_name = OrganizationLocations::where('id', $department_location)->value('location');
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

    .custom-checkbox-orange:checked {
        background-color: #FF5A1D !important;
        border-color: #FF5A1D !important;
    }

    .custom-checkbox-orange:focus {
        border-color: #FF5A1D !important;
        box-shadow: 0 0 0 0.25rem rgba(255, 90, 29, 0.25) !important;
    }

    @media (max-width: 991.98px) {
        .fixed-bottom {
            margin-left: 0 !important;
        }
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
                        <h4 class="mb-sm-0 dashboard-title">Edit Announcement</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Edit Announcement</li>
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
                                <h4 class="card-title mb-0 dashboard-title">Announcement Details</h4>
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
                                                    value="{{ $title }}">
                                                @if ($errors->has('title'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('title') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Summary</label>
                                                <input type="text" class="form-control" name="summery"
                                                    value="{{ $summery }}">
                                                @if ($errors->has('summery'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('summery') }}
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
                                                <label class="form-label text-[#556476] font-medium">Department</label>
                                                <div class="custom-select">
                                                    <button type="button" class="select-button">
                                                        <span class="selected-value">
                                                            {{ $department_name ? $department_name . ' (' . $selected_location_name . ')' : 'Select Department' }}
                                                        </span>
                                                        <span class="arrow">
                                                            <i class="ri-arrow-down-s-line"></i>
                                                        </span>
                                                    </button>
                                                    <ul class="select-dropdown hidden">
                                                        @foreach ($departments as $dept)
                                                            @php
                                                                $loc_name = OrganizationLocations::where(
                                                                    'id',
                                                                    $dept->location,
                                                                )->value('location');
                                                            @endphp
                                                            <li data-value="{{ $dept->id }}">
                                                                {{ $dept->department . ' (' . $loc_name . ')' }}
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                    <input type="hidden" name="department" value="{{ $department }}">
                                                </div>
                                                @if ($errors->has('department'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('department') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Description</label>
                                                <textarea class="form-control" id="discription"
                                                    name="discription"><?php echo $discription; ?></textarea>
                                                @if ($errors->has('discription'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('discription') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-check mb-3 p-0">
                                                <input
                                                    class="form-check-input ms-0 custom-checkbox-orange border-[#FF5A1D] rounded-1"
                                                    type="checkbox" id="formCheck6" name="notify" {{ $check }}
                                                    style="width: 18px; height: 18px; margin-right: 8px;">
                                                <label class="form-check-label text-[#556476] font-medium"
                                                    for="formCheck6" style="padding-top: 2px;">
                                                    Notify Employees
                                                </label>
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
                                onclick="window.location.href='{{ url('organization-announcements') }}'">Back</button>
                            <button type="submit" class="btn btn-theme-orange px-5 py-2">Save Announcement</button>
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
        // Initialize Summernote
        $('#discription').summernote({
            tabsize: 2,
            height: 200,
            callbacks: {
                onInit: function () {
                    $(this).next('.note-editor').addClass('card-theme shadow-none rounded-3 border');
                }
            }
        });

        // Initialize Flatpickr explicitly
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