<?php
foreach ($shift_details as $shift_detail) {
    $shift = $shift_detail->shift;
    $monday_in_time = $shift_detail->monday_in_time;
    $monday_out_time = $shift_detail->monday_out_time;
    $tuesday_in_time = $shift_detail->tuesday_in_time;
    $tuesday_out_time = $shift_detail->tuesday_out_time;
    $wednesday_in_time = $shift_detail->wednesday_in_time;
    $wednesday_out_time = $shift_detail->wednesday_out_time;
    $thursday_in_time = $shift_detail->thursday_in_time;
    $thursday_out_time = $shift_detail->thursday_out_time;
    $friday_in_time = $shift_detail->friday_in_time;
    $friday_out_time = $shift_detail->friday_out_time;
    $saturday_in_time = $shift_detail->saturday_in_time;
    $saturday_out_time = $shift_detail->saturday_out_time;
    $sunday_in_time = $shift_detail->sunday_in_time;
    $sunday_out_time = $shift_detail->sunday_out_time;
}
?>
@include('layouts.header')
<!-- Custom Styles -->
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

    .form-control:focus {
        border-color: #FF5A1D !important;
        box-shadow: none !important;
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
                        <h4 class="mb-sm-0 dashboard-title">Edit Office Shift</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Edit Office Shift</li>
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
                                <h4 class="card-title mb-0 dashboard-title">Edit Office Shift</h4>
                            </div>

                            <div class="card-body p-4 pt-0" style="overflow: visible !important; min-height: 400px;">
                                @if(Session::has('success'))
                                    <div class="alert alert-success mt-2 mb-4">{{ Session::get('success') }}</div>
                                @endif

                                <div class="live-preview">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="shift"
                                                    class="form-label text-[#556476] font-medium">Shift</label>
                                                <input type="text" class="form-control" name="shift"
                                                    value="{{ $shift }}">
                                                @if($errors->has("shift"))
                                                    <div class="alert alert-danger mt-2">{{ $errors->first('shift') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Days of Week -->
                                    <?php 
                                    $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
foreach ($days as $day) {
    $lowerDay = strtolower($day);
    $inTimeVar = $lowerDay . '_in_time';
    $outTimeVar = $lowerDay . '_out_time';
                                    ?>
                                    <div class="row mb-3">
                                        <div class="col-12">
                                            <p class="mb-2"><b>{{ $day }}</b></p>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">In Time</label>
                                                <div class="position-relative">
                                                    <input type="text" name="{{ $lowerDay }}_in_time"
                                                        value="{{ $$inTimeVar }}" class="form-control flatpickr-input"
                                                        data-provider="timepickr" data-time-basic="true"
                                                        placeholder="Select time" readonly="readonly">
                                                    <span
                                                        class="position-absolute top-50 end-0 translate-middle-y me-3 text-muted"
                                                        style="pointer-events: none;"><i
                                                            class="ri-time-line"></i></span>
                                                </div>
                                                @if($errors->has($lowerDay . "_in_time"))
                                                    <div class="alert alert-danger mt-2">
                                                {{ $errors->first($lowerDay . '_in_time') }}</div>@endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Out Time</label>
                                                <div class="position-relative">
                                                    <input type="text" name="{{ $lowerDay }}_out_time"
                                                        value="{{ $$outTimeVar }}" class="form-control flatpickr-input"
                                                        data-provider="timepickr" data-time-basic="true"
                                                        placeholder="Select time" readonly="readonly">
                                                    <span
                                                        class="position-absolute top-50 end-0 translate-middle-y me-3 text-muted"
                                                        style="pointer-events: none;"><i
                                                            class="ri-time-line"></i></span>
                                                </div>
                                                @if($errors->has($lowerDay . "_out_time"))
                                                    <div class="alert alert-danger mt-2">
                                                {{ $errors->first($lowerDay . '_out_time') }}</div>@endif
                                            </div>
                                        </div>
                                    </div>
                                    <?php } ?>

                                </div>
                            </div>
                        </div> <!-- end card -->

                        <div class="fixed-bottom bg-white border-top p-3 d-flex justify-content-between align-items-center"
                            style="z-index: 1001; margin-left: 250px;">
                            <button type="button" class="btn btn-outline-secondary px-4 py-2 action-btn-back"
                                style="color: #556476; border-color: #556476;"
                                onclick="window.location.href='{{url('office-shift')}}'">Back</button>
                            <button type="submit" class="btn btn-theme-orange px-5 py-2">Save Office Shift</button>
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
<script>
    flatpickr(".flatpickr-input[data-provider='timepickr']", {
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
    });
</script>