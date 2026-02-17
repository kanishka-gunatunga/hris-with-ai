@include('layouts.header')
<link href="{{ asset('assets/css/custom-dropdown.css') }}" rel="stylesheet" type="text/css" />

<div class="main-content">

    <div class="page-content pb-5">
        <div class="container-fluid mb-5">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="mb-sm-0 dashboard-title">Add Job Post</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Add Job Post</li>
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
                                <h4 class="card-title mb-0 dashboard-title">Add Job Post</h4>
                            </div>

                            <div class="card-body p-4 pt-0" style="overflow: visible !important; min-height: 450px;">
                                @if (Session::has('success'))
                                    <div class="alert alert-success mt-2 mb-4">{{ Session::get('success') }}</div>
                                @endif

                                <div class="live-preview">
                                    <div class="row">

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Job Title</label>
                                                <input type="text" class="form-control" name="job_title"
                                                    value="{{ old('job_title') }}">
                                                @if ($errors->has('job_title'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('job_title') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Job Type</label>
                                                <div class="custom-select">
                                                    <button type="button" class="select-button">
                                                        <span class="selected-value">
                                                            @if (old('job_type'))
                                                                {{ old('job_type') }}
                                                            @else
                                                                Select Job Type
                                                            @endif
                                                        </span>
                                                        <span class="arrow">
                                                            <i class="ri-arrow-down-s-line"></i>
                                                        </span>
                                                    </button>
                                                    <ul class="select-dropdown hidden">
                                                        <li data-value="Full Time">Full Time</li>
                                                        <li data-value="Part Time">Part Time</li>
                                                        <li data-value="Internship">Internship</li>
                                                        <li data-value="Freelance">Freelance</li>
                                                    </ul>
                                                    <input type="hidden" name="job_type" value="{{ old('job_type') }}">
                                                </div>
                                                @if ($errors->has('job_post'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('job_post') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Job
                                                    Category</label>
                                                <div class="custom-select">
                                                    <button type="button" class="select-button">
                                                        <span class="selected-value">
                                                            @if (old('job_category'))
                                                                {{ old('job_category') }}
                                                            @else
                                                                Select Job Category
                                                            @endif
                                                        </span>
                                                        <span class="arrow">
                                                            <i class="ri-arrow-down-s-line"></i>
                                                        </span>
                                                    </button>
                                                    <ul class="select-dropdown hidden">
                                                        <li data-value="PHP">PHP</li>
                                                        <li data-value="SEO">SEO</li>
                                                        <li data-value="Analyst">Analyst</li>
                                                    </ul>
                                                    <input type="hidden" name="job_category"
                                                        value="{{ old('job_category') }}">
                                                </div>
                                                @if ($errors->has('job_category'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('job_category') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">No Of
                                                    Vacancy</label>
                                                <input type="text" class="form-control" name="no_of_vacancy"
                                                    value="{{ old('no_of_vacancy') }}">
                                                @if ($errors->has('no_of_vacancy'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('no_of_vacancy') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Date Of
                                                    Closing</label>
                                                <div class="position-relative">
                                                    <input id="closing_date" name="date_of_closing"
                                                        value="{{ old('date_of_closing') }}" type="text"
                                                        class="form-control flatpickr-input active"
                                                        data-provider="flatpickr" data-date-format="n/j/Y"
                                                        readonly="readonly">
                                                    <span
                                                        class="position-absolute top-50 end-0 translate-middle-y me-3 text-muted"
                                                        style="pointer-events: none;">
                                                        <i class="ri-calendar-2-line"></i>
                                                    </span>
                                                </div>
                                                @if ($errors->has('date_of_closing'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('date_of_closing') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Gender</label>
                                                <div class="custom-select">
                                                    <button type="button" class="select-button">
                                                        <span class="selected-value">
                                                            @if (old('gender'))
                                                                {{ old('gender') }}
                                                            @else
                                                                Select Gender
                                                            @endif
                                                        </span>
                                                        <span class="arrow">
                                                            <i class="ri-arrow-down-s-line"></i>
                                                        </span>
                                                    </button>
                                                    <ul class="select-dropdown hidden">
                                                        <li data-value="Male">Male</li>
                                                        <li data-value="Female">Female</li>
                                                    </ul>
                                                    <input type="hidden" name="gender" value="{{ old('gender') }}">
                                                </div>
                                                @if ($errors->has('gender'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('gender') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Minimum
                                                    Experience</label>
                                                <div class="custom-select">
                                                    <button type="button" class="select-button">
                                                        <span class="selected-value">
                                                            @if (old('minimum_experience'))
                                                                {{ old('minimum_experience') }}
                                                            @else
                                                                Select Experience
                                                            @endif
                                                        </span>
                                                        <span class="arrow">
                                                            <i class="ri-arrow-down-s-line"></i>
                                                        </span>
                                                    </button>
                                                    <ul class="select-dropdown hidden">
                                                        <li data-value="Fresh">Fresh</li>
                                                        <li data-value="1 Year">1 Year</li>
                                                        <li data-value="2 Year">2 Year</li>
                                                        <li data-value="3 Year">3 Year</li>
                                                        <li data-value="4 Year">4 Year</li>
                                                        <li data-value="5 Year">5 Year</li>
                                                        <li data-value="6 Year">6 Year</li>
                                                        <li data-value="7 Year">7 Year</li>
                                                        <li data-value="8 Year">8 Year</li>
                                                        <li data-value="9 Year">9 Year</li>
                                                        <li data-value="10 Year">10 Year</li>
                                                        <li data-value="10+ Year">10+ Year</li>
                                                    </ul>
                                                    <input type="hidden" name="minimum_experience"
                                                        value="{{ old('minimum_experience') }}">
                                                </div>
                                                @if ($errors->has('minimum_experience'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('minimum_experience') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Is
                                                    Featured?</label>
                                                <div class="custom-select">
                                                    <button type="button" class="select-button">
                                                        <span class="selected-value">
                                                            @if (old('is_featured'))
                                                                {{ old('is_featured') }}
                                                            @else
                                                                Select Option
                                                            @endif
                                                        </span>
                                                        <span class="arrow">
                                                            <i class="ri-arrow-down-s-line"></i>
                                                        </span>
                                                    </button>
                                                    <ul class="select-dropdown hidden">
                                                        <li data-value="Yes">Yes</li>
                                                        <li data-value="No">No</li>
                                                    </ul>
                                                    <input type="hidden" name="is_featured"
                                                        value="{{ old('is_featured') }}">
                                                </div>
                                                @if ($errors->has('is_featured'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('is_featured') }}
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
                                                            @if (old('status'))
                                                                {{ old('status') }}
                                                            @else
                                                                Select Status
                                                            @endif
                                                        </span>
                                                        <span class="arrow">
                                                            <i class="ri-arrow-down-s-line"></i>
                                                        </span>
                                                    </button>
                                                    <ul class="select-dropdown hidden">
                                                        <li data-value="Unpublished">Unpublished</li>
                                                        <li data-value="Published">Published</li>
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
                                                <label class="form-label text-[#556476] font-medium">Short
                                                    Description</label>
                                                <textarea class="form-control"
                                                    name="short_description">{{ old('short_description') }}</textarea>
                                                @if ($errors->has('short_description'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('short_description') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Long
                                                    Description</label>
                                                <textarea class="form-control" id="long_discription"
                                                    name="long_discription"
                                                    rows="5">{{ old('long_discription') }}</textarea>
                                                @if ($errors->has('long_discription'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('long_discription') }}
                                                    </div>
                                                @endif
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
                                onclick="window.location.href='{{ url('job-post') }}'">Back</button>
                            <button type="submit" class="btn btn-theme-orange px-5 py-2">Save as Job Post</button>
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

                            /* Custom Orange Theme for Choices.js and Flatpickr */
                            .choices__list--dropdown .choices__item--selectable.is-highlighted {
                                background-color: #FF5A1D !important;
                            }

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
                                color: #fff !important;
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
    $(document).ready(function () {
        // Initialize Summernote
        $('#long_discription').summernote({
            tabsize: 2,
            height: 200,
            callbacks: {
                onInit: function () {
                    $(this).next('.note-editor').addClass('card-theme shadow-none rounded-3 border');
                }
            }
        });

        // Initialize Flatpickr explicitly
        flatpickr("#closing_date", {
            dateFormat: "n/j/Y",
            disableMobile: "true"
        });
    });
</script>