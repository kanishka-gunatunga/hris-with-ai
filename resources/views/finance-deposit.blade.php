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
                        <h4 class="mb-sm-0 dashboard-title">Deposits</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Deposits</li>
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
                            <h5 class="card-title mb-0 dashboard-title">Deposits</h5>
                            <a href="{{ url('add-deposit') }}" class="btn btn-theme-orange">Add Deposit</a>
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
                                            <th class="ps-4">Account</th>
                                            <th>Payer</th>
                                            <th>Amount</th>
                                            <th>Category</th>
                                            <th>Reference No</th>
                                            <th>Payment Mode</th>
                                            <th>Date</th>
                                            <th>Attachment</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($deposits as $deposit) {
    $account_name = FinanceAccountList::where('id', $deposit->account)->value('account_name');
    $payer_name = FinancePayer::where('id', $deposit->payer)->value('name');
                                   ?>
                                        <tr>
                                            <td class="ps-4">{{ $account_name }} </td>
                                            <td>{{ $payer_name }} </td>
                                            <td>{{ $deposit->amount }} </td>
                                            <td>{{ $deposit->category }} </td>
                                            <td>{{ $deposit->reference_no }} </td>
                                            <td>{{ $deposit->payment_mode }} </td>
                                            <td>{{ $deposit->date }} </td>
                                            <td>
                                                @if($deposit->attachment)
                                                    <a href="{{ asset('financial_attchments/' . $deposit->attachment . '') }}"
                                                        class="btn btn-sm btn-soft-info" download>
                                                        <i class="ri-download-2-line me-1"></i> Download
                                                    </a>
                                                @else
                                                    <span class="text-muted">No file</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <div class="d-flex justify-content-center gap-2">
                                                    <a href="{{ url('edit-finance-deposit/' . $deposit->id) }}"
                                                        class="btn-icon-soft-blue" title="Edit">
                                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2"
                                                            stroke-linecap="round" stroke-linejoin="round">
                                                            <path
                                                                d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7">
                                                            </path>
                                                            <path
                                                                d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z">
                                                            </path>
                                                        </svg>
                                                    </a>
                                                    <a href="{{ url('delete-finance-deposit/' . $deposit->id) }}"
                                                        class="btn-icon-soft-red" title="Delete">
                                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2"
                                                            stroke-linecap="round" stroke-linejoin="round">
                                                            <polyline points="3 6 5 6 21 6"></polyline>
                                                            <path
                                                                d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                            </path>
                                                        </svg>
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




        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
    @include('layouts.footer')