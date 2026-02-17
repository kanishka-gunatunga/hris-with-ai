<?php
use App\Models\OtherEmployeeDetails;
use App\Models\OtherAdminDetails;
use App\Models\OtherHRManagerDetails;
use App\Models\OtherHODDetails;
use App\Models\OtherAuthoriserDetails;
use App\Models\User;
?>
@include('layouts.header')

<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="mb-sm-0 dashboard-title">Approve Checkout Time</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Approve Checkout Time</li>
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
                            <h5 class="card-title mb-0 dashboard-title">Checkout Approval Requests</h5>
                            <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap"
                                rel="stylesheet">
                        </div>
                        @if(Session::has('success'))
                        <div class="alert alert-success m-3">{{ Session::get('success') }}</div>@endif

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
                                            <th class="ps-4">ID</th>
                                            <th>Name</th>
                                            <th>Date</th>
                                            <th>Time</th>
                                            <th>Reason</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (Auth::user()->user_role == 1) { ?>
                                        <?php
    foreach ($attendences as $attendence) {
        $user_role = User::where('id', $attendence->user_id)->value('user_role');
        $name = '';
        if ($user_role == 1) {
            $name = OtherAdminDetails::where('user_id', $attendence->user_id)->value('first_name') . ' ' . OtherAdminDetails::where('user_id', $attendence->user_id)->value('last_name');
        } elseif ($user_role == 2) {
            $name = OtherHRManagerDetails::where('user_id', $attendence->user_id)->value('first_name') . ' ' . OtherHRManagerDetails::where('user_id', $attendence->user_id)->value('last_name');
        } elseif ($user_role == 3) {
            $name = OtherEmployeeDetails::where('user_id', $attendence->user_id)->value('first_name') . ' ' . OtherEmployeeDetails::where('user_id', $attendence->user_id)->value('last_name');
        } elseif ($user_role == 5) {
            $name = OtherHODDetails::where('user_id', $attendence->user_id)->value('name');
        } elseif ($user_role == 6) {
            $name = OtherAuthoriserDetails::where('user_id', $attendence->user_id)->value('name');
        }
                                        ?>
                                        <tr>
                                            <td class="ps-4">{{$attendence->id}}</td>
                                            <td>{{$name ?? ''}}</td>
                                            <td>{{$attendence->year_month_date}}</td>
                                            <td>{{$attendence->time_}}</td>
                                            <td>{{$attendence->Reason}}</td>
                                            <td class="text-center">
                                                <div class="d-flex justify-content-center gap-2">
                                                    <a href="{{ url('accept-chekout-time/' . $attendence->id) }}"
                                                        class="btn-icon-soft-green" title="Accept">
                                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2"
                                                            stroke-linecap="round" stroke-linejoin="round">
                                                            <polyline points="20 6 9 17 4 12"></polyline>
                                                        </svg>
                                                    </a>
                                                    <a href="{{ url('reject-chekout-time/' . $attendence->id) }}"
                                                        class="btn-icon-soft-red" title="Reject">
                                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2"
                                                            stroke-linecap="round" stroke-linejoin="round">
                                                            <line x1="18" y1="6" x2="6" y2="18"></line>
                                                            <line x1="6" y1="6" x2="18" y2="18"></line>
                                                        </svg>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php    } ?>
                                        <?php } else { ?>
                                        <?php
    foreach ($attendences as $attendence) {
        $user_role = User::where('id', $attendence->user_id)->value('user_role');
        $showRow = false;
        $name = '';

        if ($user_role == 2) {
            $name = OtherHRManagerDetails::where('user_id', $attendence->user_id)->value('first_name') . ' ' . OtherHRManagerDetails::where('user_id', $attendence->user_id)->value('last_name');
            $responsible_person = OtherHRManagerDetails::where('user_id', $attendence->user_id)->value('responsible_person');
            if ($responsible_person == Auth::user()->id)
                $showRow = true;
        } elseif ($user_role == 3) {
            $name = OtherEmployeeDetails::where('user_id', $attendence->user_id)->value('first_name') . ' ' . OtherEmployeeDetails::where('user_id', $attendence->user_id)->value('last_name');
            $responsible_person = OtherEmployeeDetails::where('user_id', $attendence->user_id)->value('responsible_person');
            if ($responsible_person == Auth::user()->id)
                $showRow = true;
        } elseif ($user_role == 5) {
            $name = OtherHODDetails::where('user_id', $attendence->user_id)->value('name');
            $responsible_person = OtherHODDetails::where('user_id', $attendence->user_id)->value('responsible_person');
            if ($responsible_person == Auth::user()->id)
                $showRow = true;
        } elseif ($user_role == 6) {
            $name = OtherAuthoriserDetails::where('user_id', $attendence->user_id)->value('name');
            $responsible_person = OtherAuthoriserDetails::where('user_id', $attendence->user_id)->value('responsible_person');
            if ($responsible_person == Auth::user()->id)
                $showRow = true;
        }

        if ($showRow) {
                                        ?>
                                        <tr>
                                            <td class="ps-4">{{$attendence->id}}</td>
                                            <td>{{$name}}</td>
                                            <td>{{$attendence->year_month_date}}</td>
                                            <td>{{$attendence->time_}}</td>
                                            <td>{{$attendence->Reason}}</td>
                                            <td class="text-center">
                                                <div class="d-flex justify-content-center gap-2">
                                                    <a href="{{ url('accept-chekout-time/' . $attendence->id) }}"
                                                        class="btn-icon-soft-green" title="Accept">
                                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2"
                                                            stroke-linecap="round" stroke-linejoin="round">
                                                            <polyline points="20 6 9 17 4 12"></polyline>
                                                        </svg>
                                                    </a>
                                                    <a href="{{ url('reject-chekout-time/' . $attendence->id) }}"
                                                        class="btn-icon-soft-red" title="Reject">
                                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2"
                                                            stroke-linecap="round" stroke-linejoin="round">
                                                            <line x1="18" y1="6" x2="6" y2="18"></line>
                                                            <line x1="6" y1="6" x2="18" y2="18"></line>
                                                        </svg>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php 
                                            }
    } 
                                        ?>
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