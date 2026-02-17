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
                        <h4 class="mb-sm-0 dashboard-title">Add Asset</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Add Asset</li>
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
                                <h4 class="card-title mb-0 dashboard-title">Add Asset</h4>
                            </div>

                            <div class="card-body p-4 pt-0" style="overflow: visible !important; min-height: 400px;">
                                @if(Session::has('success'))
                                    <div class="alert alert-success mt-2 mb-4">{{ Session::get('success') }}</div>
                                @endif

                                <div class="live-preview">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Asset Name</label>
                                                <input type="text" class="form-control" name="asset_name"
                                                    value="{{ old('asset_name') }}">
                                                @if($errors->has("asset_name"))
                                                    <div class="alert alert-danger mt-2">{{ $errors->first('asset_name') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Asset Code</label>
                                                <input type="text" class="form-control" name="asset_code"
                                                    value="{{ old('asset_code') }}">
                                                @if($errors->has("asset_code"))
                                                    <div class="alert alert-danger mt-2">{{ $errors->first('asset_code') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Category</label>
                                                <div class="custom-select">
                                                    <button type="button" class="select-button">
                                                        <span
                                                            class="selected-value">{{ old('category') ? (\App\Models\AssetCategory::find(old('category'))->category ?? 'Select Category') : 'Select Category' }}</span>
                                                        <span class="arrow"><i class="ri-arrow-down-s-line"></i></span>
                                                    </button>
                                                    <ul class="select-dropdown hidden">
                                                        <?php foreach ($categorys as $category) { ?>
                                                        <li data-value="{{$category->id}}">{{$category->category}}</li>
                                                        <?php } ?>
                                                    </ul>
                                                    <input type="hidden" name="category" value="{{ old('category') }}">
                                                </div>
                                                @if($errors->has("category"))
                                                    <div class="alert alert-danger mt-2">{{ $errors->first('category') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Is Working</label>
                                                <div class="custom-select">
                                                    <button type="button" class="select-button">
                                                        <span
                                                            class="selected-value">{{ old('is_working') ?? 'Select Is Working' }}</span>
                                                        <span class="arrow"><i class="ri-arrow-down-s-line"></i></span>
                                                    </button>
                                                    <ul class="select-dropdown hidden">
                                                        <li data-value="Yes">Yes</li>
                                                        <li data-value="No">No</li>
                                                        <li data-value="On Maintence">On Maintence</li>
                                                    </ul>
                                                    <input type="hidden" name="is_working"
                                                        value="{{ old('is_working') }}">
                                                </div>
                                                @if($errors->has("is_working"))
                                                    <div class="alert alert-danger mt-2">{{ $errors->first('is_working') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Employee</label>
                                                <div class="custom-select">
                                                    <button type="button" class="select-button">
                                                        <span class="selected-value">
                                                            <?php
if (old('employee')) {
    $emp = \App\Models\OtherEmployeeDetails::where('user_id', old('employee'))->first();
    echo $emp ? $emp->first_name . ' ' . $emp->last_name : 'Select Employee';
} else {
    echo 'Select Employee';
}
                                                            ?>
                                                        </span>
                                                        <span class="arrow"><i class="ri-arrow-down-s-line"></i></span>
                                                    </button>
                                                    <ul class="select-dropdown hidden">
                                                        <?php foreach ($employees as $employee) { ?>
                                                        <li data-value="{{$employee->user_id}}">
                                                            {{$employee->first_name . ' ' . $employee->last_name}}
                                                        </li>
                                                        <?php } ?>
                                                    </ul>
                                                    <input type="hidden" name="employee" value="{{ old('employee') }}">
                                                </div>
                                                @if($errors->has("employee"))
                                                    <div class="alert alert-danger mt-2">{{ $errors->first('employee') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Purchase
                                                    Date</label>
                                                <div class="position-relative">
                                                    <input name="purchase_date" value="{{ old('purchase_date') }}"
                                                        type="text" class="form-control flatpickr-input active"
                                                        data-provider="flatpickr" data-date-format="n/j/Y"
                                                        readonly="readonly" placeholder="Select date">
                                                    <span
                                                        class="position-absolute top-50 end-0 translate-middle-y me-3 text-muted"
                                                        style="pointer-events: none;">
                                                        <i class="ri-calendar-2-line"></i>
                                                    </span>
                                                </div>
                                                @if($errors->has("purchase_date"))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('purchase_date') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Warranty/AMC End
                                                    Date</label>
                                                <div class="position-relative">
                                                    <input name="end_date" value="{{ old('end_date') }}" type="text"
                                                        class="form-control flatpickr-input active"
                                                        data-provider="flatpickr" data-date-format="n/j/Y"
                                                        readonly="readonly" placeholder="Select date">
                                                    <span
                                                        class="position-absolute top-50 end-0 translate-middle-y me-3 text-muted"
                                                        style="pointer-events: none;">
                                                        <i class="ri-calendar-2-line"></i>
                                                    </span>
                                                </div>
                                                @if($errors->has("end_date"))
                                                    <div class="alert alert-danger mt-2">{{ $errors->first('end_date') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label
                                                    class="form-label text-[#556476] font-medium">Manufacturer</label>
                                                <input type="text" class="form-control" name="manufacturer"
                                                    value="{{ old('manufacturer') }}">
                                                @if($errors->has("manufacturer"))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('manufacturer') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Invoice
                                                    Number</label>
                                                <input type="text" class="form-control" name="invoice_number"
                                                    value="{{ old('invoice_number') }}">
                                                @if($errors->has("invoice_number"))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('invoice_number') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Serial
                                                    Number</label>
                                                <input type="text" class="form-control" name="serial_number"
                                                    value="{{ old('serial_number') }}">
                                                @if($errors->has("serial_number"))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('serial_number') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Assets
                                                    Image</label>
                                                <input type="file" class="form-control" name="image">
                                                @if($errors->has("image"))
                                                    <div class="alert alert-danger mt-2">{{ $errors->first('image') }}</div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Asset Note</label>
                                                <textarea id="asset_note"
                                                    name="asset_note">{{ old('asset_note') }}</textarea>
                                                @if($errors->has("asset_note"))
                                                    <div class="alert alert-danger mt-2">{{ $errors->first('asset_note') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="fixed-bottom bg-white border-top p-3 d-flex justify-content-between align-items-center"
                            style="z-index: 1001; margin-left: 250px;">
                            <button type="button" class="btn btn-outline-secondary px-4 py-2 action-btn-back"
                                style="color: #556476; border-color: #556476;"
                                onclick="window.location.href='{{url('assets-page')}}'">Back</button>
                            <button type="submit" class="btn btn-theme-orange px-5 py-2">Save as Asset</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
</div>
@include('layouts.footer')
<script src="{{ asset('assets/js/custom-dropdown.js') }}"></script>
<script>
    flatpickr(".flatpickr-input", {
        dateFormat: "n/j/Y",
    });

    $(document).ready(function () {
        $('#asset_note').summernote({
            tabsize: 2,
            height: 100
        });
    });
</script>