@include('layouts.header')
<?php

foreach ($interview_details as $interview_detail)  {
    $title = $interview_detail->title;
    $scheduled_by =$interview_detail->scheduled_by;
    $interview_time =$interview_detail->interview_time;
    $interviewer =$interview_detail->interviewer;
    $status =$interview_detail->status;
    $notes =$interview_detail->notes;
}
?>
<div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0">Edit Interview Update</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                        <li class="breadcrumb-item active">Edit Interview Update</li>
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
                                    <h4 class="card-title mb-0 flex-grow-1">Edit Interview Update</h4>

                                </div><!-- end card header -->

                                <form method="POST" action="" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                <div class="d-flex flex-wrap gap-2 mb-4">
                                <button type="submit" class="btn btn-info">Save Interview Update</button>
                                </div>
                                @if(Session::has('success')) <div class="alert alert-success mb-4">{{ Session::get('success') }}</div>@endif
                                    <div class="live-preview">

                                            <div class="row">
                                            <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="firstNameinput" class="form-label">Title</label>
                                            <input type="text" class="form-control" name="title" value="{{$title}}">
                                            @if($errors->has("title")) <div class="alert alert-danger mt-2">{{ $errors->first('title') }}</li></div>@endif
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="firstNameinput" class="form-label">Scheduled By</label>
                                            <input type="text" class="form-control" name="scheduled_by" value="{{$scheduled_by}}">
                                            @if($errors->has("scheduled_by")) <div class="alert alert-danger mt-2">{{ $errors->first('scheduled_by') }}</li></div>@endif
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="firstNameinput" class="form-label">Interview Time</label>
                                                        <input value="{{$interview_time}}" name="interview_time" type="text" class="form-control flatpickr-input active" data-provider="flatpickr" data-date-format="Y-m-d" data-enable-time="" readonly="readonly">
                                                        @if($errors->has("interview_time")) <div class="alert alert-danger mt-2">{{ $errors->first('interview_time') }}</li></div>@endif
                                                    </div>
                                                </div>
                                     <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="firstNameinput" class="form-label">Interviewer</label>
                                            <input value="{{$interviewer}}" type="text" class="form-control" name="interviewer" >
                                            @if($errors->has("interviewer")) <div class="alert alert-danger mt-2">{{ $errors->first('interviewer') }}</li></div>@endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="firstNameinput" class="form-label">Status</label>
                                                        <select class="form-control" data-choices  id="choices-single-default" name="status" >
                                                        <option value="{{$status}}" selected hidden>{{$status}}</option>
                                                        <option value="Finished">Finished</option>
                                                        <option value="Not Finished">Not Finished</option>
                                                        </select>
                                                        @if($errors->has("status")) <div class="alert alert-danger mt-2">{{ $errors->first('status') }}</li></div>@endif
                                                    </div>
                                                </div>
                                    <div class="col-md-12">
                                                    <div class="mb-3">
                                                        <label for="firstNameinput" class="form-label">Notes</label>
                                                        <textarea class="form-control" name="notes" >{{$notes}}</textarea>
                                                        @if($errors->has("notes")) <div class="alert alert-danger mt-2">{{ $errors->first('notes') }}</li></div>@endif
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
