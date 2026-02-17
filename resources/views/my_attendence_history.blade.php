@include('layouts.header')
<?php
use App\Models\OtherEmployeeDetails;
use App\Models\User;
?>
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="mb-sm-0 dashboard-title">Attendance History</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Attendance History</li>
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
                            <h5 class="card-title mb-0 dashboard-title">My Attendance Records</h5>
                            <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap"
                                rel="stylesheet">
                            <a href="{{url('add-checkout-time')}}" class="btn btn-theme-orange">Add Missing Checkout
                                Time</a>
                        </div>
                        @if(Session::has('success'))
                        <div class="alert alert-success m-3">{{ Session::get('success') }}</div>@endif

                        <div class="card-body p-0">
                            <style>
                                #buttons-datatables2_wrapper {
                                    padding: 20px;
                                }

                                .konnect-table-wrapper {
                                    overflow-x: auto !important;
                                }

                                #buttons-datatables2_wrapper .dataTables_paginate {
                                    float: none;
                                    text-align: center;
                                    margin-top: 10px;
                                    display: flex;
                                    justify-content: center;
                                    width: 100%;
                                }
                            </style>
                            <div class="konnect-table-wrapper table-responsive">
                                <table id="buttons-datatables2" class="display table konnect-table mb-0"
                                    style="width:100%">
                                    <thead>
                                        <tr>
                                            <th class="ps-4">ID</th>
                                            <th>Type</th>
                                            <th>Date</th>
                                            <th>Time</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
foreach ($attendences as $attendence) {
    $name = OtherEmployeeDetails::where('user_id', $attendence->user_id)->value('first_name') . ' ' . OtherEmployeeDetails::where('user_id', $attendence->user_id)->value('last_name');
                                        ?>
                                        <tr>
                                            <td class="ps-4">{{$attendence->id}}</td>
                                            <td>
                                                @if($attendence->check_in_or_out == 'Check-In')
                                                    <span class="badge bg-soft-success text-success">Check-In</span>
                                                @else
                                                    <span class="badge bg-soft-warning text-warning">Check-Out</span>
                                                @endif
                                            </td>
                                            <td>{{$attendence->year_month_date}}</td>
                                            <td>{{$attendence->time_}}</td>
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
    <script>
        $(document).ready(function () {
            $('#buttons-datatables2').DataTable({
                "order": [[0, "desc"]] // Sort by column 0 (ID) descending
            });
        });
    </script>