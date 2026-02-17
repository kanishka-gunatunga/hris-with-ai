@include('layouts.header')
<!-- Custom Styles -->
<link href="{{ asset('assets/css/custom-dropdown.css') }}" rel="stylesheet" type="text/css" />

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

    /* Custom styling for inputs */
    .form-control:focus {
        border-color: #FF5A1D;
        box-shadow: 0 0 0 0.25rem rgba(255, 90, 29, 0.25);
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

<div class="main-content">
    <div class="page-content pb-10">
        <div class="container-fluid mb-10">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="mb-sm-0 dashboard-title">Form C</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Form C</li>
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
                                <h4 class="card-title mb-0 dashboard-title">Form C Details</h4>
                            </div>

                            <div class="card-body p-4 pt-0" style="overflow: visible !important; min-height: 250px;">
                                @if(Session::has('success'))
                                    <div class="alert alert-success mt-2 mb-4">{{ Session::get('success') }}</div>
                                @endif

                                <div class="live-preview">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="epf_reg_no"
                                                    class="form-label text-[#556476] font-medium">E.P.F Register
                                                    No</label>
                                                <input type="text" class="form-control" name="epf_reg_no"
                                                    value="{{ old('epf_reg_no') }}">
                                                @if($errors->has("epf_reg_no"))
                                                    <div class="alert alert-danger mt-2">{{ $errors->first('epf_reg_no') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="year_month"
                                                    class="form-label text-[#556476] font-medium">Year and Month (EG :
                                                    2022-01)</label>
                                                <div class="position-relative">
                                                    <input name="year_month" value="{{ old('year_month') }}" type="text"
                                                        class="form-control flatpickr-input active"
                                                        data-provider="flatpickr" data-date-format="Y-m" id="year_month"
                                                        readonly="readonly">
                                                    <span
                                                        class="position-absolute top-50 end-0 translate-middle-y me-3 text-muted"
                                                        style="pointer-events: none;">
                                                        <i class="ri-calendar-2-line"></i>
                                                    </span>
                                                </div>
                                                @if($errors->has("year_month"))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('year_month') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="surcharges"
                                                    class="form-label text-[#556476] font-medium">Surcharges</label>
                                                <input type="text" class="form-control" name="surcharges"
                                                    value="{{ old('surcharges') }}">
                                                @if($errors->has("surcharges"))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('surcharges') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="cheque_no"
                                                    class="form-label text-[#556476] font-medium">Cheque No</label>
                                                <input type="text" class="form-control" name="cheque_no"
                                                    value="{{ old('cheque_no') }}">
                                                @if($errors->has("cheque_no"))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('cheque_no') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="bank_and_branch"
                                                    class="form-label text-[#556476] font-medium">Bank Name and Branch
                                                    Name</label>
                                                <input type="text" class="form-control" name="bank_and_branch"
                                                    value="{{ old('bank_and_branch') }}">
                                                @if($errors->has("bank_and_branch"))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('bank_and_branch') }}
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
                                onclick="window.location.href='{{ url('dashboard') }}'">Back</button>
                            <button type="submit" class="btn btn-theme-orange px-5 py-2">Download Form C</button>
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
    flatpickr("#year_month", {
        dateFormat: "Y-m",
    });
</script>