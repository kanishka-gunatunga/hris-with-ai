<?php
use App\Models\FinanceAccountList;
use App\Models\FinancePayee;
foreach ($expense_details as $expense_detail) {

    $account = $expense_detail->account;
    $category = $expense_detail->category;
    $amount = $expense_detail->amount;
    $date = $expense_detail->date;
    $payee = $expense_detail->payee;
    $reference_no = $expense_detail->reference_no;
    $discription = $expense_detail->discription;
    $payment_mode = $expense_detail->payment_mode;

    $account_name = FinanceAccountList::where('id', $account)->value('account_name');
    $payee_name = FinancePayee::where('id', $payee)->value('name');
}

?>
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

    /* Custom Orange Theme for flatpickr */
    .flatpickr-day.selected,
    .flatpickr-day.startRange,
    .flatpickr-day.endRange {
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

<div class="main-content">
    <div class="page-content pb-10">
        <div class="container-fluid mb-10">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="mb-sm-0 dashboard-title">Edit Expense</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Edit Expense</li>
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
                                <h4 class="card-title mb-0 dashboard-title">Expense Details</h4>
                            </div>

                            <div class="card-body p-4 pt-0" style="min-height: 400px;">
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
                                                        <span class="selected-value">{{ $account_name }}</span>
                                                        <span class="arrow">
                                                            <i class="ri-arrow-down-s-line"></i>
                                                        </span>
                                                    </button>
                                                    <ul class="select-dropdown hidden">
                                                        <?php foreach ($accounts as $acc) { ?>
                                                        <li data-value="{{ $acc->id }}"
                                                            class="{{ $acc->id == $account ? 'selected' : '' }}">
                                                            {{ $acc->account_name }}
                                                        </li>
                                                        <?php } ?>
                                                    </ul>
                                                    <input type="hidden" name="account" value="{{ $account }}">
                                                </div>
                                                @if ($errors->has('account'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('account') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Category</label>
                                                <div class="custom-select">
                                                    <button type="button" class="select-button">
                                                        <span class="selected-value">{{ $category }}</span>
                                                        <span class="arrow">
                                                            <i class="ri-arrow-down-s-line"></i>
                                                        </span>
                                                    </button>
                                                    <ul class="select-dropdown hidden">
                                                        <li data-value="Envato"
                                                            class="{{ $category == 'Envato' ? 'selected' : '' }}">
                                                            Envato</li>
                                                        <li data-value="Salary"
                                                            class="{{ $category == 'Salary' ? 'selected' : '' }}">
                                                            Salary</li>
                                                        <li data-value="Interest Income"
                                                            class="{{ $category == 'Interest Income' ? 'selected' : '' }}">
                                                            Interest Income</li>
                                                        <li data-value="Regular Income"
                                                            class="{{ $category == 'Regular Income' ? 'selected' : '' }}">
                                                            Regular Income</li>
                                                        <li data-value="Part Time Work"
                                                            class="{{ $category == 'Part Time Work' ? 'selected' : '' }}">
                                                            Part Time Work</li>
                                                        <li data-value="Other Income"
                                                            class="{{ $category == 'Other Income' ? 'selected' : '' }}">
                                                            Other Income</li>
                                                    </ul>
                                                    <input type="hidden" name="category" value="{{ $category }}">
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
                                                    value="{{ $amount }}">
                                                @if ($errors->has('amount'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('amount') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Date</label>
                                                <div class="position-relative">
                                                    <input name="date" value="{{ $date }}" type="text"
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
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('date') }}
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
                                                        <span class="selected-value">{{ $payment_mode }}</span>
                                                        <span class="arrow">
                                                            <i class="ri-arrow-down-s-line"></i>
                                                        </span>
                                                    </button>
                                                    <ul class="select-dropdown hidden">
                                                        <li data-value="Paypal"
                                                            class="{{ $payment_mode == 'Paypal' ? 'selected' : '' }}">
                                                            Paypal</li>
                                                        <li data-value="Bank"
                                                            class="{{ $payment_mode == 'Bank' ? 'selected' : '' }}">
                                                            Bank</li>
                                                        <li data-value="Cash"
                                                            class="{{ $payment_mode == 'Cash' ? 'selected' : '' }}">
                                                            Cash</li>
                                                    </ul>
                                                    <input type="hidden" name="payment_mode"
                                                        value="{{ $payment_mode }}">
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
                                                        <span class="selected-value">{{ $payee_name }}</span>
                                                        <span class="arrow">
                                                            <i class="ri-arrow-down-s-line"></i>
                                                        </span>
                                                    </button>
                                                    <ul class="select-dropdown hidden">
                                                        <?php foreach ($payees as $p) { ?>
                                                        <li data-value="{{ $p->id }}"
                                                            class="{{ $p->id == $payee ? 'selected' : '' }}">
                                                            {{ $p->name }}
                                                        </li>
                                                        <?php } ?>
                                                    </ul>
                                                    <input type="hidden" name="payee" value="{{ $payee }}">
                                                </div>
                                                @if ($errors->has('payee'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('payee') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Reference
                                                    No</label>
                                                <input type="text" class="form-control" name="reference_no"
                                                    value="{{ $reference_no }}">
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
                                                    name="discription">{{ $discription }}</textarea>
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
                            <a href="{{ url('finance-expense') }}"
                                class="btn btn-outline-secondary px-4 py-2 action-btn-back"
                                style="color: #556476; border-color: #556476;">Back</a>
                            <button type="submit" class="btn btn-theme-orange px-5 py-2">Save Expense</button>
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
    flatpickr("#expense_date", {
        dateFormat: "n/j/Y",
    });
</script>