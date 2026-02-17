@include('layouts.header')
<link href="{{ asset('assets/css/custom-dropdown.css') }}" rel="stylesheet" type="text/css" />

<div class="main-content">

    <div class="page-content pb-10">
        <div class="container-fluid mb-10">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="mb-sm-0 dashboard-title">Add Recruitment</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Add Recruitment</li>
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
                            <div
                                class="card-header border-0 bg-white p-4 d-flex justify-content-between align-items-center">
                                <h4 class="card-title mb-0 dashboard-title">Recruitment Details</h4>
                                <button type="submit" class="btn btn-theme-orange px-4 py-2">Save as
                                    Recruitment</button>
                            </div>

                            <div class="card-body p-4 pt-0" style="overflow: visible !important; min-height: 400px;">
                                @if (Session::has('success'))
                                    <div class="alert alert-success mt-2 mb-4">{{ Session::get('success') }}</div>
                                @endif

                                <div class="live-preview">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Job Post</label>
                                                <div class="custom-select">
                                                    <button type="button" class="select-button">
                                                        <span class="selected-value">
                                                            @if (old('job_post'))
                                                                @foreach ($job_posts as $job_post)
                                                                    @if ($job_post->id == old('job_post'))
                                                                        {{ $job_post->job_title }}
                                                                    @endif
                                                                @endforeach
                                                            @else
                                                                Select Job Post
                                                            @endif
                                                        </span>
                                                        <span class="arrow">
                                                            <i class="ri-arrow-down-s-line"></i>
                                                        </span>
                                                    </button>
                                                    <ul class="select-dropdown hidden">
                                                        @foreach ($job_posts as $job_post)
                                                            <li data-value="{{ $job_post->id }}">
                                                                {{ $job_post->job_title }}
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                    <input type="hidden" name="job_post" value="{{ old('job_post') }}">
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
                                                <label class="form-label text-[#556476] font-medium">Name</label>
                                                <input type="text" class="form-control" name="name"
                                                    value="{{ old('name') }}">
                                                @if ($errors->has('name'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('name') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Phone
                                                    Number</label>
                                                <input type="text" class="form-control" name="phone"
                                                    value="{{ old('phone') }}">
                                                @if ($errors->has('phone'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('phone') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>


                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">E-Mail</label>
                                                <input type="email" class="form-control" name="email"
                                                    value="{{ old('email') }}">
                                                @if ($errors->has('email'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('email') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Location</label>
                                                <input type="text" class="form-control" name="location"
                                                    value="{{ old('location') }}">
                                                @if ($errors->has('location'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('location') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">CV</label>
                                                <input type="file" class="form-control" name="cv">
                                                @if ($errors->has('cv'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('cv') }}
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

                        <style>
                            /* Custom Orange Theme for Choices.js */
                            .choices__list--dropdown .choices__item--selectable.is-highlighted {
                                background-color: #FF5A1D !important;
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