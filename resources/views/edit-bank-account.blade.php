<?php

foreach ($bank_details as $bank_detail)  {
    $account_title = $bank_detail->account_title;
    $account_number = $bank_detail->account_number;
    $bank_name = $bank_detail->bank_name;
    $bank_code = $bank_detail->bank_code;
    $bank_branch = $bank_detail->bank_branch;

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
                                <h4 class="mb-sm-0">Edit Bank Account</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                        <li class="breadcrumb-item active">Edit Bank Account</li>
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
                                    <h4 class="card-title mb-0 flex-grow-1">Edit Bank Account</h4>

                                </div><!-- end card header -->

                                <form  action="" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                <div class="d-flex flex-wrap gap-2 mb-4">
                                <button type="submit" class="btn btn-info">Save Bank Account</button>

                                </div>
                                @if(Session::has('success')) <div class="alert alert-success mb-4">{{ Session::get('success') }}</div>@endif
                                    <div class="live-preview">

                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="firstNameinput" class="form-label">Account Title</label>
                                                        <input type="text" class="form-control" name="account_title" value="{{ $account_title }}">
                                                        @if($errors->has("account_title")) <div class="alert alert-danger mt-2">{{ $errors->first('account_title') }}</li></div>@endif
                                                    </div>
                                                </div>
                                                <!--end col-->
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="firstNameinput" class="form-label">Account Number</label>
                                                        <input type="text" class="form-control" name="account_number" value="{{ $account_number }}">
                                                        @if($errors->has("account_number")) <div class="alert alert-danger mt-2">{{ $errors->first('account_number') }}</li></div>@endif
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="firstNameinput" class="form-label">Bank Name</label>
                                                        <input type="text" class="form-control" name="bank_name" value="{{ $bank_name }}">
                                                        @if($errors->has("bank_name")) <div class="alert alert-danger mt-2">{{ $errors->first('bank_name') }}</li></div>@endif
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="firstNameinput" class="form-label">Bank Code</label>
                                                        <input type="text" class="form-control" name="bank_code" value="{{ $bank_code }}">
                                                        @if($errors->has("bank_code")) <div class="alert alert-danger mt-2">{{ $errors->first('bank_code') }}</li></div>@endif
                                                    </div>
                                                </div>
                                                <!--end col-->
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="firstNameinput" class="form-label">Bank Branch</label>
                                                        <input type="text" class="form-control" name="bank_branch" value="{{ $bank_branch }}">
                                                        @if($errors->has("bank_branch")) <div class="alert alert-danger mt-2">{{ $errors->first('bank_branch') }}</li></div>@endif
                                                    </div>
                                                </div>
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
<script>

    $('#asset_note').summernote({
        tabsize: 2,
        height: 100
      });
</script>
