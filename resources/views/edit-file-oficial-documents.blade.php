<?php
foreach ($doc_details as $doc_detail) {

    $title = $doc_detail->title;
    $document_type = $doc_detail->document_type;
    $identification_number = $doc_detail->identification_number;
    $expired_date = $doc_detail->expired_date;
    $notification = $doc_detail->notification;
    $discription = $doc_detail->discription;

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

    /* Custom Oragge Theme for Choices.js and Dropdowns */
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
                        <h4 class="mb-sm-0 dashboard-title">Edit Official Document</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Edit Official Document</li>
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
                                <h4 class="card-title mb-0 dashboard-title">Document Details</h4>
                            </div>

                            <div class="card-body p-4 pt-0" style="overflow: visible !important; min-height: 400px;">
                                @if(Session::has('success'))
                                    <div class="alert alert-success mt-2 mb-4">{{ Session::get('success') }}</div>
                                @endif

                                <div class="live-preview">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="title"
                                                    class="form-label text-[#556476] font-medium">Title</label>
                                                <input type="text" class="form-control" name="title"
                                                    value="{{ $title }}">
                                                @if($errors->has("title"))
                                                    <div class="alert alert-danger mt-2">{{ $errors->first('title') }}</div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="document_type"
                                                    class="form-label text-[#556476] font-medium">Document Type</label>
                                                <div class="custom-select">
                                                    <button type="button" class="select-button">
                                                        <span class="selected-value">{{ $document_type }}</span>
                                                        <span class="arrow">
                                                            <i class="ri-arrow-down-s-line"></i>
                                                        </span>
                                                    </button>
                                                    <ul class="select-dropdown hidden">
                                                        <li data-value="Driving Licesnse">Driving Licesnse</li>
                                                        <li data-value="Passport">Passport</li>
                                                        <li data-value="National Id">National Id</li>
                                                    </ul>
                                                    <input type="hidden" name="document_type"
                                                        value="{{ $document_type }}">
                                                </div>
                                                @if($errors->has("document_type"))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('document_type') }}</div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="identification_number"
                                                    class="form-label text-[#556476] font-medium">Identification
                                                    Currently Number</label>
                                                <input type="text" class="form-control" name="identification_number"
                                                    value="{{ $identification_number }}">
                                                @if($errors->has("identification_number"))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('identification_number') }}</div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Expired
                                                    Date</label>
                                                <div class="position-relative">
                                                    <input name="expired_date" value="{{ $expired_date }}" type="text"
                                                        class="form-control flatpickr-input active"
                                                        data-provider="flatpickr" data-date-format="n/j/Y"
                                                        id="expired_date" readonly="readonly">
                                                    <span
                                                        class="position-absolute top-50 end-0 translate-middle-y me-3 text-muted"
                                                        style="pointer-events: none;">
                                                        <i class="ri-calendar-2-line"></i>
                                                    </span>
                                                </div>
                                                @if($errors->has("expired_date"))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('expired_date') }}</div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="notification"
                                                    class="form-label text-[#556476] font-medium">Notification</label>
                                                <div class="custom-select">
                                                    <button type="button" class="select-button">
                                                        <span class="selected-value">{{ $notification }}</span>
                                                        <span class="arrow">
                                                            <i class="ri-arrow-down-s-line"></i>
                                                        </span>
                                                    </button>
                                                    <ul class="select-dropdown hidden">
                                                        <li data-value="No Alarm">No Alarm</li>
                                                        <li data-value="One Week">One Week</li>
                                                        <li data-value="15 Days">15 Days</li>
                                                        <li data-value="One Month">One Month</li>
                                                    </ul>
                                                    <input type="hidden" name="notification"
                                                        value="{{ $notification }}">
                                                </div>
                                                @if($errors->has("notification"))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('notification') }}</div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="document"
                                                    class="form-label text-[#556476] font-medium">Document File (Leave
                                                    empty to keep existing)</label>
                                                <input type="file" class="form-control" name="document">
                                                @if(isset($doc_detail->document) && $doc_detail->document)
                                                    <small class="text-muted">Current File: <a
                                                            href="{{ asset('file_manager_docs/' . $doc_detail->document) }}"
                                                            target="_blank">{{ $doc_detail->document }}</a></small>
                                                @endif
                                                @if($errors->has("document"))
                                                    <div class="alert alert-danger mt-2">{{ $errors->first('document') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="discription"
                                                    class="form-label text-[#556476] font-medium">Description</label>
                                                <textarea class="form-control"
                                                    name="discription">{{ $discription }}</textarea>
                                                @if($errors->has("discription"))
                                                    <div class="alert alert-danger mt-2">{{ $errors->first('discription') }}
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
                                onclick="window.location.href='{{ url('file-oficial-documents') }}'">Back</button>
                            <button type="submit" class="btn btn-theme-orange px-5 py-2">Save Official Document</button>
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
    flatpickr("#expired_date", {
        dateFormat: "n/j/Y",
    });
</script>