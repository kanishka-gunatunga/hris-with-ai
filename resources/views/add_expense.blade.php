<?php
use App\Models\FinanceAccountList;
use App\Models\FinancePayee;
?>
@include('layouts.header')
<link href="{{ asset('assets/css/custom-dropdown.css') }}" rel="stylesheet" type="text/css" />
<div class="main-content">

    <div class="page-content pb-5">
        <div class="container-fluid mb-5">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="mb-sm-0 dashboard-title">Add Expense</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Add Expense</li>
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
                        <div class="card card-theme shadow-none rounded-3 border-0">
                            <div class="card-header border-0 bg-white p-4">
                                <h4 class="card-title mb-0 dashboard-title">Add Expense</h4>
                            </div>

                            <div class="card-body p-4 pt-0">
                                @if (Session::has('success'))
                                    <div class="alert alert-success mt-2 mb-4">{{ Session::get('success') }}</div>
                                @endif

                                <div class="live-preview">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Account</label>
                                                <div class="custom-select">
                                                    <button type="button" class="select-button">
                                                        <span class="selected-value">Select Account</span>
                                                        <span class="arrow">
                                                            <i class="ri-arrow-down-s-line"></i>
                                                        </span>
                                                    </button>
                                                    <ul class="select-dropdown hidden">
                                                        <?php foreach($accounts as $account){ ?>
                                                        <li data-value="{{ $account->id }}">
                                                            {{ $account->account_name }}</li>
                                                        <?php } ?>
                                                    </ul>
                                                    <input type="hidden" name="account" value="{{ old('account') }}">
                                                </div>
                                                @if ($errors->has('account'))
                                                    <div class="alert alert-danger mt-2">{{ $errors->first('account') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Category</label>
                                                <div class="custom-select">
                                                    <button type="button" class="select-button">
                                                        <span class="selected-value">Select Category</span>
                                                        <span class="arrow">
                                                            <i class="ri-arrow-down-s-line"></i>
                                                        </span>
                                                    </button>
                                                    <ul class="select-dropdown hidden">
                                                        <li data-value="Envato">Envato</li>
                                                        <li data-value="Salary">Salary</li>
                                                        <li data-value="Interest Income">Interest Income</li>
                                                        <li data-value="Regular Income">Regular Income</li>
                                                        <li data-value="Part Time Work">Part Time Work</li>
                                                        <li data-value="Other Income">Other Income</li>
                                                    </ul>
                                                    <input type="hidden" name="category" value="{{ old('category') }}">
                                                </div>
                                                @if ($errors->has('category'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('category') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Amount</label>
                                                <input type="number" class="form-control" name="amount"
                                                    value="{{ old('amount') }}">
                                                @if ($errors->has('amount'))
                                                    <div class="alert alert-danger mt-2">{{ $errors->first('amount') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Date</label>
                                                <div class="position-relative">
                                                    <input name="date" value="{{ old('date') }}" type="text"
                                                        class="form-control flatpickr-input active"
                                                        data-provider="flatpickr" data-date-format="n/j/Y"
                                                        id="expense_date">
                                                    <span
                                                        class="position-absolute top-50 end-0 translate-middle-y me-3 text-muted"
                                                        style="pointer-events: none;">
                                                        <i class="ri-calendar-2-line"></i>
                                                    </span>
                                                </div>
                                                @if ($errors->has('date'))
                                                    <div class="alert alert-danger mt-2">{{ $errors->first('date') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Payment
                                                    Mode</label>
                                                <div class="custom-select">
                                                    <button type="button" class="select-button">
                                                        <span class="selected-value">Select Payment Mode</span>
                                                        <span class="arrow">
                                                            <i class="ri-arrow-down-s-line"></i>
                                                        </span>
                                                    </button>
                                                    <ul class="select-dropdown hidden">
                                                        <li data-value="Paypal">Paypal</li>
                                                        <li data-value="Bank">Bank</li>
                                                        <li data-value="Cash">Cash</li>
                                                    </ul>
                                                    <input type="hidden" name="payment_mode"
                                                        value="{{ old('payment_mode') }}">
                                                </div>
                                                @if ($errors->has('payment_mode'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('payment_mode') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Payee</label>
                                                <div class="custom-select">
                                                    <button type="button" class="select-button">
                                                        <span class="selected-value">Select Payee</span>
                                                        <span class="arrow">
                                                            <i class="ri-arrow-down-s-line"></i>
                                                        </span>
                                                    </button>
                                                    <ul class="select-dropdown hidden">
                                                        <?php foreach($payees as $payee){ ?>
                                                        <li data-value="{{ $payee->id }}">{{ $payee->name }}</li>
                                                        <?php } ?>
                                                    </ul>
                                                    <input type="hidden" name="payee" value="{{ old('payee') }}">
                                                </div>
                                                @if ($errors->has('payee'))
                                                    <div class="alert alert-danger mt-2">{{ $errors->first('payee') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Reference
                                                    No</label>
                                                <input type="text" class="form-control" name="reference_no"
                                                    value="{{ old('reference_no') }}">
                                                @if ($errors->has('reference_no'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('reference_no') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Description</label>
                                                <textarea class="form-control"
                                                    name="discription">{{ old('discription') }}</textarea>
                                                @if ($errors->has('discription'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('discription') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Attach File</label>
                                                <input type="file" class="form-control" name="attachment">
                                                @if ($errors->has('attachment'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('attachment') }}
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
                                onclick="window.location.href='{{ url('finance-expense') }}'">Back</button>
                            <button type="submit" class="btn btn-theme-orange px-5 py-2">Save Expense</button>
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

                            /* Custom Orange Theme for flatpickr */

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

                            .flatpickr-calendar {
                                z-index: 9999 !important;
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
    flatpickr("#expense_date", {
        dateFormat: "n/j/Y",
    });
</script>