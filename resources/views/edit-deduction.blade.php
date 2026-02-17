<?php

foreach ($deduction_details as $deduction_detail)  {
    $month_year = $deduction_detail->month_year;
    $deduction_option =$deduction_detail->deduction_option;
    $title =$deduction_detail->title;
    $amount =$deduction_detail->amount;
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
                                <h4 class="mb-sm-0">Edit Deduction</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                        <li class="breadcrumb-item active">Edit Deduction</li>
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
                                    <h4 class="card-title mb-0 flex-grow-1">Edit Deduction</h4>

                                </div><!-- end card header -->

                                <form  action="" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                <div class="d-flex flex-wrap gap-2 mb-4">
                                <button type="submit" class="btn btn-info">Save Deduction</button>

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
                                                        <label for="firstNameinput" class="form-label">Deduction Option</label>
                                                        <select class="form-control" data-choices  id="choices-single-default" name="deduction_option" >
                                                        <option selected hidden="" >{{$deduction_option}}</option>
                                            <option value="Social Security System">Social Security System</option>
                                            <option value="Health insurance Coparation">Health insurance Coparation</option>
                                            <option value="Home Develpment Mutual Funds">Home Develpment Mutual Funds</option>
                                            <option value="Withdrowing Tax on Wages">Withdrowing Tax on Wages</option>
                                             <option value="Other Satuary Deductions">Other Satuary Deductions</option>
                                                        </select>
                                                        @if($errors->has("deduction_option")) <div class="alert alert-danger mt-2">{{ $errors->first('deduction_option') }}</li></div>@endif
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
                                                        <label for="firstNameinput" class="form-label">Amount</label>
                                                        <input type="text" class="form-control" name="amount" value="{{ $amount }}">
                                                        @if($errors->has("amount")) <div class="alert alert-danger mt-2">{{ $errors->first('amount') }}</li></div>@endif
                                                    </div>
                                                </div>
                                                <!--end col-->

                                                <!--end col-->
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
