<?php

foreach ($loan_details as $loan_detail)  {
    $month_year = $loan_detail->month_year;
    $loan_option =$loan_detail->loan_option;
    $title =$loan_detail->title;
    $amount =$loan_detail->amount;
    $number_of_installments =$loan_detail->number_of_installments;
    $reason =$loan_detail->reason;
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
                                <h4 class="mb-sm-0">Edit Loan</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                        <li class="breadcrumb-item active">Edit Loan</li>
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
                                    <h4 class="card-title mb-0 flex-grow-1">Edit Loan</h4>

                                </div><!-- end card header -->

                                <form  action="" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                <div class="d-flex flex-wrap gap-2 mb-4">
                                <button type="submit" class="btn btn-info">Save Loan</button>

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
                                                        <label for="firstNameinput" class="form-label">Loan Option</label>
                                                        <select class="form-control" data-choices  id="choices-single-default" name="loan_option" >
                                                        <option selected hidden>{{$loan_option}}</option>
                                            <option value="Social Security System Loan">Social Security System Loan</option>
                                            <option value="Home Development Mututal Fund Loan">Home Development Mututal Fund Loan</option>
                                            <option value="Other Loan">Other Loan</option>
                                                        </select>
                                                        @if($errors->has("loan_option")) <div class="alert alert-danger mt-2">{{ $errors->first('loan_option') }}</li></div>@endif
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
                                                        <input type="number" class="form-control" name="amount" value="{{ $amount }}">
                                                        @if($errors->has("amount")) <div class="alert alert-danger mt-2">{{ $errors->first('amount') }}</li></div>@endif
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="firstNameinput" class="form-label">Number of Installments</label>
                                                        <input type="number" class="form-control" name="number_of_installments" value="{{ $number_of_installments }}">
                                                        @if($errors->has("number_of_installments")) <div class="alert alert-danger mt-2">{{ $errors->first('number_of_installments') }}</li></div>@endif
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="firstNameinput" class="form-label">Reason</label>
                                                        <textarea class="form-control" name="reason" >{{ $reason }}</textarea>
                                                        @if($errors->has("reason")) <div class="alert alert-danger mt-2">{{ $errors->first('reason') }}</li></div>@endif
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
