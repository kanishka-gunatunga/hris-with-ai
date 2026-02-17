@include('layouts.header')
<?php
use App\Models\OrganizationDepartments;
use App\Models\OrganizationLocations;
use App\Models\EventsDepartments;

$event_title = "";
$event_date = "";
$event_time = "";
$status = "";
$event_note = "";
$notification = "";
$check = "";
$event_departments_ids = [];

foreach ($event_details as $event_detail) {
    $event_title = $event_detail->event_title;
    $event_date = $event_detail->event_date;
    $event_time = $event_detail->event_time;
    $status = $event_detail->status;
    $event_note = $event_detail->event_note;
    $notification = $event_detail->notification;
    if ($notification == "on") {
        $check = "checked";
    }
    $event_departments = EventsDepartments::where('event_id', $event_detail->id)->get();
    foreach ($event_departments as $ed) {
        $event_departments_ids[] = $ed->department_id;
    }
}
?>
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

    .select-dropdown {
        z-index: 1050 !important;
    }

    .form-control:focus {
        border-color: #FF5A1D !important;
        box-shadow: none !important;
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

    <div class="page-content pb-5">
        <div class="container-fluid mb-5">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="mb-sm-0 dashboard-title">Edit Event</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Edit Event</li>
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
                                <h4 class="card-title mb-0 dashboard-title">Edit Event</h4>
                            </div>

                            <div class="card-body p-4 pt-0" style="overflow: visible !important; min-height: 400px;">
                                @if(Session::has('success'))
                                    <div class="alert alert-success mt-2 mb-4">{{ Session::get('success') }}</div>
                                @endif

                                <div class="live-preview">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Event Title</label>
                                                <input type="text" class="form-control" name="event_title"
                                                    value="{{ $event_title }}" placeholder="Enter event title">
                                                @if($errors->has("event_title"))
                                                    <div class="alert alert-danger mt-2">{{ $errors->first('event_title') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Event Date</label>
                                                <div class="position-relative">
                                                    <input name="event_date" value="{{ $event_date }}" type="text"
                                                        class="form-control flatpickr-input active"
                                                        data-provider="flatpickr" data-date-format="n/j/Y"
                                                        id="event_date" placeholder="Select date">
                                                    <span
                                                        class="position-absolute top-50 end-0 translate-middle-y me-3 text-muted"
                                                        style="pointer-events: none;">
                                                        <i class="ri-calendar-2-line"></i>
                                                    </span>
                                                </div>
                                                @if($errors->has("event_date"))
                                                    <div class="alert alert-danger mt-2">{{ $errors->first('event_date') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Event Time</label>
                                                <div class="position-relative">
                                                    <input type="text" name="event_time" value="{{ $event_time }}"
                                                        class="form-control flatpickr-input" data-provider="timepickr"
                                                        data-time-basic="true" id="timepicker-example"
                                                        placeholder="Select time" readonly="readonly">
                                                    <span
                                                        class="position-absolute top-50 end-0 translate-middle-y me-3 text-muted"
                                                        style="pointer-events: none;">
                                                        <i class="ri-time-line"></i>
                                                    </span>
                                                </div>
                                                @if($errors->has("event_time"))
                                                    <div class="alert alert-danger mt-2">{{ $errors->first('event_time') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Status</label>
                                                <div class="custom-select">
                                                    <button type="button" class="select-button">
                                                        <span
                                                            class="selected-value">{{ $status ?? 'Select Status' }}</span>
                                                        <span class="arrow"><i class="ri-arrow-down-s-line"></i></span>
                                                    </button>
                                                    <ul class="select-dropdown hidden">
                                                        <li data-value="Pending">Pending</li>
                                                        <li data-value="Approved">Approved</li>
                                                        <li data-value="Postponed">Postponed</li>
                                                    </ul>
                                                    <input type="hidden" name="status" value="{{ $status }}">
                                                </div>
                                                @if($errors->has("status"))
                                                    <div class="alert alert-danger mt-2">{{ $errors->first('status') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-8">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Departments</label>
                                                <select class="form-control" name="departments[]"
                                                    id="departments_select" multiple>
                                                    <?php foreach ($departments as $department) {
    $location_name = OrganizationLocations::where('id', $department->location)->value('location');
    $selected = in_array($department->id, $event_departments_ids) ? "selected" : "";
                                                    ?>
                                                    <option value="{{ $department->id }}" {{ $selected }}>
                                                        {{$department->department . ' (' . $location_name . ')'}}
                                                    </option>
                                                    <?php } ?>
                                                </select>
                                                @if($errors->has("departments"))
                                                    <div class="alert alert-danger mt-2">{{ $errors->first('departments') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Event Note</label>
                                                <textarea class="form-control" name="event_note" rows="3"
                                                    placeholder="Enter additional notes">{{ $event_note }}</textarea>
                                                @if($errors->has("event_note"))
                                                    <div class="alert alert-danger mt-2">{{ $errors->first('event_note') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-check form-switch mb-3">
                                                <input class="form-check-input" type="checkbox" id="notificationSwitch"
                                                    name="notification" {{ $check }}>
                                                <label class="form-check-label" for="notificationSwitch">Send
                                                    Notification</label>
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
                                onclick="window.location.href='{{url('events')}}'">Back</button>
                            <button type="submit" class="btn btn-theme-orange px-5 py-2">Save Event</button>
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
    document.addEventListener('DOMContentLoaded', function () {
        var element = document.getElementById('departments_select');
        if (element) {
            new Choices(element, {
                removeItemButton: true
            });
        }
    });

    flatpickr("#event_date", {
        dateFormat: "n/j/Y",
    });

    flatpickr("#timepicker-example", {
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
    });
</script>