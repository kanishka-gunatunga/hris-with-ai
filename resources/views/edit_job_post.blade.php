@include('layouts.header')
<?php
use App\Models\OtherEmployeeDetails;
use App\Models\OtherClientDetails;
use App\Models\PMProjectsEmployees;

$job_title = $job_type = $job_category = $no_of_vacancy = $date_of_closing = $gender = $minimum_experience = $is_featured = $status = $short_description = $long_discription = '';

foreach ($job_details as $job_detail) {
    $job_title = $job_detail->job_title;
    $job_type = $job_detail->job_type;
    $job_category = $job_detail->job_category;
    $no_of_vacancy = $job_detail->no_of_vacancy;
    $date_of_closing = $job_detail->date_of_closing;
    $gender = $job_detail->gender;
    $minimum_experience = $job_detail->minimum_experience;
    $is_featured = $job_detail->is_featured;
    $status = $job_detail->status;
    $short_description = $job_detail->short_description;
    $long_discription = $job_detail->long_discription;
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
                        <h4 class="mb-sm-0 dashboard-title">Edit Job Post</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Edit Job Post</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xxl-12">
                    <form method="POST" action="" enctype="multipart/form-data">
                        @csrf
                        <div class="card card-theme shadow-none rounded-3 border-0"
                            style="overflow: visible !important;">
                            <div class="card-header border-0 bg-white p-4">
                                <h4 class="card-title mb-0 dashboard-title">Job Details</h4>
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
                                                    value="{{ $job_title }}">
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
                                                            {{ $job_type ?: 'Select Job Type' }}
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
                                                    <input type="hidden" name="job_type" value="{{ $job_type }}">
                                                </div>
                                                @if ($errors->has('job_type'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('job_type') }}
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
                                                            {{ $job_category ?: 'Select Job Category' }}
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
                                                        value="{{ $job_category }}">
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
                                                    value="{{ $no_of_vacancy }}">
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
                                                    <input id="date_of_closing" name="date_of_closing"
                                                        value="{{ $date_of_closing }}" type="text"
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
                                                            {{ $gender ?: 'Select Gender' }}
                                                        </span>
                                                        <span class="arrow">
                                                            <i class="ri-arrow-down-s-line"></i>
                                                        </span>
                                                    </button>
                                                    <ul class="select-dropdown hidden">
                                                        <li data-value="Male">Male</li>
                                                        <li data-value="Female">Female</li>
                                                    </ul>
                                                    <input type="hidden" name="gender" value="{{ $gender }}">
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
                                                            {{ $minimum_experience ?: 'Select Experience' }}
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
                                                        value="{{ $minimum_experience }}">
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
                                                            {{ $is_featured ?: 'Select Option' }}
                                                        </span>
                                                        <span class="arrow">
                                                            <i class="ri-arrow-down-s-line"></i>
                                                        </span>
                                                    </button>
                                                    <ul class="select-dropdown hidden">
                                                        <li data-value="Yes">Yes</li>
                                                        <li data-value="No">No</li>
                                                    </ul>
                                                    <input type="hidden" name="is_featured" value="{{ $is_featured }}">
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
                                                            {{ $status ?: 'Select Status' }}
                                                        </span>
                                                        <span class="arrow">
                                                            <i class="ri-arrow-down-s-line"></i>
                                                        </span>
                                                    </button>
                                                    <ul class="select-dropdown hidden">
                                                        <li data-value="Unpublished">Unpublished</li>
                                                        <li data-value="Published">Published</li>
                                                    </ul>
                                                    <input type="hidden" name="status" value="{{ $status }}">
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
                                                <textarea class="form-control" name="short_description"
                                                    rows="3">{{ $short_description }}</textarea>
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
                                                    name="long_discription"><?php echo $long_discription; ?></textarea>
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

                        <div class="row mt-4">
                            <div class="col-lg-12">
                                <div class="card card-theme shadow-none rounded-3 border-0">
                                    <div class="card-header border-0 bg-white p-4">
                                        <h5 class="card-title mb-0 dashboard-title">Recruitments</h5>
                                    </div>
                                    <div class="card-body p-4 pt-0">
                                        <div class="table-responsive">
                                            <table id="buttons-datatables"
                                                class="display table table-bordered dt-responsive nowrap"
                                                style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Phone</th>
                                                        <th>Email</th>
                                                        <th>Location</th>
                                                        <th>CV</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($recruitments as $recruitment) { ?>
                                                    <tr>
                                                        <td>{{ $recruitment->name }}</td>
                                                        <td>{{ $recruitment->phone }}</td>
                                                        <td>{{ $recruitment->email }}</td>
                                                        <td>{{ $recruitment->location }}</td>
                                                        <td><a href="{{ asset('recruitment_cvs/' . $recruitment->cv . '') }}"
                                                                download class="text-primary">Download</a></td>
                                                        <td>
                                                            <div class="d-flex gap-2">
                                                                <a href="{{ url('edit-recruitment/' . $recruitment->id) }}"
                                                                    class="btn btn-sm btn-soft-info">
                                                                    <i class="ri-pencil-fill"></i>
                                                                </a>
                                                                <a href="{{ url('delete-recruitment/' . $recruitment->id) }}"
                                                                    class="btn btn-sm btn-soft-danger">
                                                                    <i class="ri-delete-bin-fill"></i>
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="fixed-bottom bg-white border-top p-3 d-flex justify-content-between align-items-center"
                            style="z-index: 1001; margin-left: 250px;">
                            <a href="{{ url('job-post') }}" class="btn btn-outline-secondary px-4 py-2 action-btn-back"
                                style="color: #556476; border-color: #556476;">Back</a>
                            <button type="submit" class="btn btn-theme-orange px-5 py-2">Save Job Post</button>
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
        $('#long_discription').summernote({
            tabsize: 2,
            height: 200,
            callbacks: {
                onInit: function () {
                    $(this).next('.note-editor').addClass('card-theme shadow-none rounded-3 border');
                }
            }
        });

        // Initialize Flatpickr
        flatpickr("#date_of_closing", {
            dateFormat: "n/j/Y",
            disableMobile: "true"
        });
    });
</script>