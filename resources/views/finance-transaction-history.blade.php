@include('layouts.header')
<?php
use App\Models\FinanceAccountList;
use App\Models\FinancePayer;
?>
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="mb-sm-0 dashboard-title">Transaction History</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Transaction History</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->



            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-theme shadow-none rounded-3 border-0">
                        <div
                            class="card-header d-flex justify-content-between align-items-center p-3 border-0 bg-white">
                            <h5 class="card-title mb-0 dashboard-title">Transaction History</h5>
                        </div>
                        @if (Session::has('success'))
                            <div class="alert alert-success m-3">{{ Session::get('success') }}</div>
                        @endif

                        <div class="card-body p-0">
                            <style>
                                #buttons-datatables_wrapper {
                                    padding: 20px;
                                }

                                .konnect-table-wrapper {
                                    overflow-x: auto !important;
                                }
                            </style>
                            <div class="konnect-table-wrapper table-responsive">
                                <table id="buttons-datatables" class="display table konnect-table mb-0"
                                    style="width:100%">
                                    <thead>
                                        <tr>
                                            <th class="ps-4">Date</th>
                                            <th>Account</th>
                                            <th>Amount</th>
                                            <th>Type</th>
                                            <th>Payment Mode</th>
                                            <th>Reference No</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($deposits as $deposit) {
    $account_name = FinanceAccountList::where('id', $deposit->account)->value('account_name');
                                    ?>
                                        <tr>
                                            <td class="ps-4">{{ $deposit->date }} </td>
                                            <td>{{ $account_name }}</td>
                                            <td>{{ $deposit->amount }} </td>
                                            <td><span class="badge badge-soft-success">Deposit</span></td>
                                            <td>{{ $deposit->payment_mode }}</td>
                                            <td>{{ $deposit->reference_no }}</td>
                                        </tr>
                                        <?php } ?>
                                        <?php foreach ($expenses as $expense) {
    $account_name = FinanceAccountList::where('id', $expense->account)->value('account_name');
                                    ?>
                                        <tr>
                                            <td class="ps-4">{{ $expense->date }} </td>
                                            <td>{{ $account_name }}</td>
                                            <td>{{ $expense->amount }} </td>
                                            <td><span class="badge badge-soft-danger">Expense</span></td>
                                            <td>{{ $expense->payment_mode }}</td>
                                            <td>{{ $expense->reference_no }}</td>
                                        </tr>
                                        <?php } ?>
                                        <?php foreach ($transfers as $transfer) {
    $to_account_name = FinanceAccountList::where('id', $transfer->to_account)->value('account_name');
    $from_account_name = FinanceAccountList::where('id', $transfer->from_account)->value('account_name');
                                    ?>
                                        <tr>
                                            <td class="ps-4">{{ $transfer->date }} </td>
                                            <td>
                                                <div class="d-flex flex-column">
                                                    <span class="text-muted small">FROM: {{ $from_account_name }}</span>
                                                    <span class="text-success small">TO: {{ $to_account_name }}</span>
                                                </div>
                                            </td>
                                            <td>{{ $transfer->amount }} </td>
                                            <td><span class="badge badge-soft-info">Transfer</span></td>
                                            <td>{{ $transfer->payment_mode }}</td>
                                            <td>{{ $transfer->reference_no }}</td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>




        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
    @include('layouts.footer')