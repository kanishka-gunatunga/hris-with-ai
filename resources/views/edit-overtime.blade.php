<?php

foreach ($overtime_details as $overtime_detail)  {
    $month_year = $overtime_detail->month_year;
    $title =$overtime_detail->title;
    $no_of_days =$overtime_detail->no_of_days;
    $total_hours =$overtime_detail->total_hours;
    $rate =$overtime_detail->rate;
}
?>
@include('layouts.header')
<div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0">Edit Overtime</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                        <li class="breadcrumb-item active">Edit Overtime</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->


                    <div class="row">
                        <div class="col-xxl-12" style="margin:auto;">
                            <div class="card">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Edit Overtime</h4>

                                </div><!-- end card header -->

                                <form  action="" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                <div class="d-flex flex-wrap gap-2 mb-4">
                                <button type="submit" class="btn btn-info">Save Overtime</button>

                                </div>
                                @if(Session::has('success')) <div class="alert alert-success mb-4">{{ Session::get('success') }}</div>@endif
                                    <div class="live-preview">

                                            <div class="row">
                                            <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="firstNameinput" class="form-label">Month Year</label>
                                                        <input name="month_year" value="{{$month_year}}" type="text" class="form-control flatpickr-input active" data-provider="flatpickr" data-date-format="Y-m" readonly="readonly" >
                                                        @if($errors->has("month_year")) <div class="alert alert-danger mt-2">{{ $errors->first('month_year') }}</li></div>@endif
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="firstNameinput" class="form-label">Title</label>
                                                        <input type="text" class="form-control" name="title" value="{{ $title }}">
                                                        @if($errors->has("title")) <div class="alert alert-danger mt-2">{{ $errors->first('title') }}</li></div>@endif
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="firstNameinput" class="form-label">Number of Days</label>
                                                        <input type="text" class="form-control" name="no_of_days" value="{{ $no_of_days }}">
                                                        @if($errors->has("no_of_days")) <div class="alert alert-danger mt-2">{{ $errors->first('no_of_days') }}</li></div>@endif
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="firstNameinput" class="form-label">Total Hours</label>
                                                        <input type="text" class="form-control" name="total_hours" value="{{ $total_hours }}">
                                                        @if($errors->has("total_hours")) <div class="alert alert-danger mt-2">{{ $errors->first('total_hours') }}</li></div>@endif
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="firstNameinput" class="form-label">Rate</label>
                                                        <input type="text" class="form-control" name="rate" value="{{ $rate }}">
                                                        @if($errors->has("rate")) <div class="alert alert-danger mt-2">{{ $errors->first('rate') }}</li></div>@endif
                                                    </div>
                                                </div>

                                               
                                            </div>
                                            <!--end row-->
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div> <!-- end col -->

                        </div>



                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->
@include('layouts.footer')
