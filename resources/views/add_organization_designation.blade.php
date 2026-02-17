<?php
use App\Models\OtherHODDetails;
use App\Models\OrganizationLocations;

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
                        <h4 class="mb-sm-0 dashboard-title">Add Designation</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Add Designation</li>
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
                                <h4 class="card-title mb-0 dashboard-title">Designation Details</h4>
                            </div>

                            <div class="card-body p-4 pt-0" style="overflow: visible !important; min-height: 400px;">
                                @if (Session::has('success'))
                                    <div class="alert alert-success mt-2 mb-4">{{ Session::get('success') }}</div>
                                @endif

                                <div class="live-preview">
                                    <div class="row">

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Designation</label>
                                                <input type="text" class="form-control" name="designation"
                                                    value="{{ old('designation') }}">
                                                @if ($errors->has('designation'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('designation') }}
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
                                                            @if (old('department'))
                                                                @foreach ($departments as $department)
                                                                    @if ($department->id == old('department'))
                                                                        @php
                                                                            $location_name = \App\Models\OrganizationLocations::where(
                                                                                'id',
                                                                                $department->location,
                                                                            )->value('location');
                                                                        @endphp
                                                                        {{ $department->department . ' (' . $location_name . ')' }}
                                                                    @endif
                                                                @endforeach
                                                            @else
                                                                Select Department
                                                            @endif
                                                        </span>
                                                        <span class="arrow">
                                                            <i class="ri-arrow-down-s-line"></i>
                                                        </span>
                                                    </button>
                                                    <ul class="select-dropdown hidden">
                                                        @foreach ($departments as $department)
                                                            @php
                                                                $location_name = \App\Models\OrganizationLocations::where(
                                                                    'id',
                                                                    $department->location,
                                                                )->value('location');
                                                            @endphp
                                                            <li data-value="{{ $department->id }}">
                                                                {{ $department->department . ' (' . $location_name . ')' }}
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                    <input type="hidden" name="department"
                                                        value="{{ old('department') }}">
                                                </div>
                                                @if ($errors->has('department'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('department') }}
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
                                onclick="window.location.href='{{ url('organization-designations') }}'">Back</button>
                            <button type="submit" class="btn btn-theme-orange px-5 py-2">Save Designation</button>
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