<?php
use App\Models\OrganizationDepartments;
foreach ($file_details as $file_detail) {

    $file_name = $file_detail->file_name;
    $department = $file_detail->department;
    $file_link = $file_detail->file_link;
    $dep_name = OrganizationDepartments::where('id', $department)->value('department');

}

?>
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

    /* Custom Order Theme for Choices.js and Dropdowns */
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
</style>

<div class="main-content">
    <div class="page-content pb-10">
        <div class="container-fluid mb-10">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="mb-sm-0 dashboard-title">Edit File</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Edit File</li>
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
                                <h4 class="card-title mb-0 dashboard-title">File Details</h4>
                            </div>

                            <div class="card-body p-4 pt-0" style="overflow: visible !important; min-height: 400px;">
                                @if(Session::has('success'))
                                    <div class="alert alert-success mt-2 mb-4">{{ Session::get('success') }}</div>
                                @endif

                                <div class="live-preview">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="file_name"
                                                    class="form-label text-[#556476] font-medium">File Name</label>
                                                <input type="text" class="form-control" name="file_name"
                                                    value="{{ $file_name }}">
                                                @if($errors->has("file_name"))
                                                    <div class="alert alert-danger mt-2">{{ $errors->first('file_name') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="department"
                                                    class="form-label text-[#556476] font-medium">Department</label>
                                                <div class="custom-select">
                                                    <button type="button" class="select-button">
                                                        <span class="selected-value">
                                                            {{ OrganizationDepartments::where('id', $department)->value('department') }}
                                                        </span>
                                                        <span class="arrow">
                                                            <i class="ri-arrow-down-s-line"></i>
                                                        </span>
                                                    </button>
                                                    <ul class="select-dropdown hidden">
                                                        @foreach($departments as $department)
                                                            <li data-value="{{$department->id}}">{{$department->department}}
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                    <input type="hidden" name="department" value="{{ $department }}">
                                                </div>
                                                @if($errors->has("department"))
                                                    <div class="alert alert-danger mt-2">{{ $errors->first('department') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="document"
                                                    class="form-label text-[#556476] font-medium">Document File (Leave
                                                    empty to keep existing)</label>
                                                <input type="file" class="form-control" name="document">
                                                @if($file_detail->document)
                                                    <small class="text-muted">Current File: <a
                                                            href="{{ asset('file_manager_docs/' . $file_detail->document) }}"
                                                            target="_blank">{{ $file_detail->document }}</a></small>
                                                @endif
                                                @if($errors->has("document"))
                                                    <div class="alert alert-danger mt-2">{{ $errors->first('document') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="file_link"
                                                    class="form-label text-[#556476] font-medium">External Link (Drive,
                                                    Dropbox etc)</label>
                                                <input type="text" class="form-control" name="file_link"
                                                    value="{{ $file_link }}">
                                                @if($errors->has("file_link"))
                                                    <div class="alert alert-danger mt-2">{{ $errors->first('file_link') }}
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
                                onclick="window.location.href='{{ url('file-manager') }}'">Back</button>
                            <button type="submit" class="btn btn-theme-orange px-5 py-2">Save File</button>
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