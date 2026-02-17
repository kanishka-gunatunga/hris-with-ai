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
                        <h4 class="mb-sm-0 dashboard-title">Change Employment Type</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ url('employment-type-history') }}">Employment
                                        Type History</a></li>
                                <li class="breadcrumb-item active">Change Employment Type</li>
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
                                <h4 class="card-title mb-0 dashboard-title">Employment Type Details</h4>
                            </div>

                            <div class="card-body p-4 pt-0" style="overflow: visible !important; min-height: 300px;">
                                @if(Session::has('success'))
                                    <div class="alert alert-success mt-2 mb-4">{{ Session::get('success') }}</div>
                                @endif

                                <div class="live-preview">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Employee</label>
                                                <div class="custom-select">
                                                    <button type="button" class="select-button">
                                                        <span class="selected-value">Select Employee</span>
                                                        <span class="arrow"><i class="ri-arrow-down-s-line"></i></span>
                                                    </button>
                                                    <ul class="select-dropdown hidden">
                                                        @foreach($employees as $employee)
                                                            <li data-value="{{$employee->user_id}}">
                                                                {{$employee->first_name . ' ' . $employee->last_name}}</li>
                                                        @endforeach
                                                    </ul>
                                                    <input type="hidden" name="employee">
                                                </div>
                                                @if($errors->has("employee"))
                                                    <div class="alert alert-danger mt-2">{{ $errors->first('employee') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Old Employment
                                                    Type</label>
                                                <div class="custom-select">
                                                    <button type="button" class="select-button">
                                                        <span class="selected-value">Select Old Type</span>
                                                        <span class="arrow"><i class="ri-arrow-down-s-line"></i></span>
                                                    </button>
                                                    <ul class="select-dropdown hidden">
                                                        <li data-value="Full Time">Full Time</li>
                                                        <li data-value="Part Time">Part Time</li>
                                                        <li data-value="Intern">Intern</li>
                                                    </ul>
                                                    <input type="hidden" name="old_employment_type">
                                                </div>
                                                @if($errors->has("old_employment_type"))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('old_employment_type') }}</div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">New Employment
                                                    Type</label>
                                                <div class="custom-select">
                                                    <button type="button" class="select-button">
                                                        <span class="selected-value">Select New Type</span>
                                                        <span class="arrow"><i class="ri-arrow-down-s-line"></i></span>
                                                    </button>
                                                    <ul class="select-dropdown hidden">
                                                        <li data-value="Full Time">Full Time</li>
                                                        <li data-value="Part Time">Part Time</li>
                                                        <li data-value="Intern">Intern</li>
                                                    </ul>
                                                    <input type="hidden" name="new_employment_type">
                                                </div>
                                                @if($errors->has("new_employment_type"))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('new_employment_type') }}</div>
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
                                onclick="window.location.href='{{url('employment-type-history')}}'">Back</button>
                            <button type="submit" class="btn btn-theme-orange px-5 py-2">Save as Employment
                                Type</button>
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
@