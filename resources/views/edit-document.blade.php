<?php

foreach ($document_details as $document_detail)  {
    $title = $document_detail->title;
    $document_type =$document_detail->document_type;
    $discription =$document_detail->discription;
    $expire_date =$document_detail->expire_date;
    $send_notification =$document_detail->send_notification;
    if($send_notification == "yes"){
        $check = "checked";
        }
        else{
            $check = "";
    }

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
                                <h4 class="mb-sm-0">Edit Document</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                        <li class="breadcrumb-item active">Edit Document</li>
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
                                    <h4 class="card-title mb-0 flex-grow-1">Edit Document</h4>

                                </div><!-- end card header -->

                                <form  action="" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                <div class="d-flex flex-wrap gap-2 mb-4">
                                <button type="submit" class="btn btn-info">Save Document</button>

                                </div>
                                @if(Session::has('success')) <div class="alert alert-success mb-4">{{ Session::get('success') }}</div>@endif
                                    <div class="live-preview">

                                            <div class="row">


                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="firstNameinput" class="form-label">Title</label>
                                                        <input type="text" class="form-control" name="title" value="{{ $title }}">
                                                        @if($errors->has("title")) <div class="alert alert-danger mt-2">{{ $errors->first('title') }}</li></div>@endif
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="firstNameinput" class="form-label">Document Type</label>
                                                        <select class="form-control" data-choices  id="choices-single-default" name="document_type" >
                                                        <option selected hidden value="{{ $document_type }}">{{ $document_type }}</option>
                                            <option value="Driving Licesnse">Driving Licesnse</option>
                                            <option value="Passport">Passport</option>
                                            <option value="National Id">National Id</option>
                                                        </select>
                                                        @if($errors->has("document_type")) <div class="alert alert-danger mt-2">{{ $errors->first('document_type') }}</li></div>@endif
                                                    </div>
                                                </div>

                                                <!--end col-->
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="firstNameinput" class="form-label">Description</label>
                                                        <textarea class="form-control" name="discription" >{{ $discription }}</textarea>
                                                        @if($errors->has("discription")) <div class="alert alert-danger mt-2">{{ $errors->first('discription') }}</li></div>@endif
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="firstNameinput" class="form-label">Document</label>
                                                        <input type="file" class="form-control" name="document" >
                                                        @if($errors->has("document")) <div class="alert alert-danger mt-2">{{ $errors->first('document') }}</li></div>@endif
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="firstNameinput" class="form-label">Expire Date</label>
                                                        <input name="expire_date" value="{{ $expire_date }}" type="text" class="form-control flatpickr-input active" data-provider="flatpickr" data-date-format="n/j/Y" readonly="readonly" >
                                                        @if($errors->has("expire_date")) <div class="alert alert-danger mt-2">{{ $errors->first('expire_date') }}</li></div>@endif
                                                    </div>
                                                </div>
                                                <!--end col-->
                                                <div class="col-md-12">
                                                <div class="form-check mb-3">
                                                            <input class="form-check-input" type="checkbox" id="formCheck6" name="send_notification"  {{$check}}>
                                                            <label class="form-check-label" for="formCheck6">
                                                            Send Notification?
                                        (will get notification email before 3 days of expiry date)
                                                            </label>
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
