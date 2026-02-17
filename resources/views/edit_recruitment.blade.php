@include('layouts.header')
<?php

foreach ($recruitment_details as $recruitment_detail)  {
    $recruitment_id = $recruitment_detail->id;
    $name = $recruitment_detail->name;
    $phone = $recruitment_detail->phone;
    $email = $recruitment_detail->email;
    $location = $recruitment_detail->location;

}

?>
<div class="main-content">

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Edit Recruitment</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                            <li class="breadcrumb-item active">Edit Recruitment</li>
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
                        <h4 class="card-title mb-0 flex-grow-1">Edit Recruitment</h4>

                    </div><!-- end card header -->

                    <form  action="" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                    <div class="d-flex flex-wrap gap-2 mb-4">
                    <button type="submit" class="btn btn-info">Save Recruitment</button>

                    </div>
                    @if(Session::has('success')) <div class="alert alert-success mb-4">{{ Session::get('success') }}</div>@endif
                        <div class="live-preview">

                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="firstNameinput" class="form-label">Name</label>
                                            <input type="text" class="form-control" name="name" value="{{ $name }}">
                                            @if($errors->has("name")) <div class="alert alert-danger mt-2">{{ $errors->first('name') }}</li></div>@endif
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="firstNameinput" class="form-label">Phone Number</label>
                                            <input type="text" class="form-control" name="phone" value="{{ $phone }}">
                                            @if($errors->has("phone")) <div class="alert alert-danger mt-2">{{ $errors->first('phone') }}</li></div>@endif
                                        </div>
                                    </div>


                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="firstNameinput" class="form-label">E-Mail</label>
                                            <input type="email" class="form-control" name="email" value="{{ $email }}">
                                            @if($errors->has("email")) <div class="alert alert-danger mt-2">{{ $errors->first('email') }}</li></div>@endif
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="firstNameinput" class="form-label">Location</label>
                                            <input type="text" class="form-control" name="location" value="{{ $location }}">
                                            @if($errors->has("location")) <div class="alert alert-danger mt-2">{{ $errors->first('location') }}</li></div>@endif
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="firstNameinput" class="form-label">CV</label>
                                            <input type="file" class="form-control" name="cv" >
                                            @if($errors->has("cv")) <div class="alert alert-danger mt-2">{{ $errors->first('cv') }}</li></div>@endif
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

            <div class="row">
            <div class="col-xxl-6" style="margin:auto;">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Add Interview Update</h4>

                    </div><!-- end card header -->

                    <form method="POST" action="{{ url('add-interview-update/'.$recruitment_id) }}" enctype="multipart/form-data">
                @csrf
                    <div class="card-body">
                    <div class="d-flex flex-wrap gap-2 mb-4">
                    <button type="submit" class="btn btn-info">Add Interview Update</button>

                    </div>

                        <div class="live-preview">

                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="firstNameinput" class="form-label">Title</label>
                                            <input type="text" class="form-control" name="title" >
                                            @if($errors->has("title")) <div class="alert alert-danger mt-2">{{ $errors->first('title') }}</li></div>@endif
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="firstNameinput" class="form-label">Scheduled By</label>
                                            <input type="text" class="form-control" name="scheduled_by" >
                                            @if($errors->has("scheduled_by")) <div class="alert alert-danger mt-2">{{ $errors->first('scheduled_by') }}</li></div>@endif
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="firstNameinput" class="form-label">Interview Time</label>
                                                        <input name="interview_time" type="text" class="form-control flatpickr-input active" data-provider="flatpickr" data-date-format="Y-m-d" data-enable-time="" readonly="readonly">
                                                        @if($errors->has("interview_time")) <div class="alert alert-danger mt-2">{{ $errors->first('interview_time') }}</li></div>@endif
                                                    </div>
                                                </div>
                                     <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="firstNameinput" class="form-label">Interviewer</label>
                                            <input type="text" class="form-control" name="interviewer" >
                                            @if($errors->has("interviewer")) <div class="alert alert-danger mt-2">{{ $errors->first('interviewer') }}</li></div>@endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="firstNameinput" class="form-label">Status</label>
                                                        <select class="form-control" data-choices  id="choices-single-default" name="status" >
                                                        <option value="Finished">Finished</option>
                                                        <option value="Not Finished">Not Finished</option>
                                                        </select>
                                                        @if($errors->has("status")) <div class="alert alert-danger mt-2">{{ $errors->first('status') }}</li></div>@endif
                                                    </div>
                                                </div>
                                    <div class="col-md-12">
                                                    <div class="mb-3">
                                                        <label for="firstNameinput" class="form-label">Notes</label>
                                                        <textarea class="form-control" name="notes" ></textarea>
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
            <div class="col-xxl-6" style="margin:auto;">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Add Other Update</h4>

                    </div><!-- end card header -->

                    <form method="POST" action="{{ url('add-other-update/'.$recruitment_id) }}" enctype="multipart/form-data">
                @csrf
                    <div class="card-body">
                    <div class="d-flex flex-wrap gap-2 mb-4">
                    <button type="submit" class="btn btn-info">Add Other Update</button>

                    </div>

                        <div class="live-preview">

                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="firstNameinput" class="form-label">Title</label>
                                            <input type="text" class="form-control" name="title" >
                                            @if($errors->has("title")) <div class="alert alert-danger mt-2">{{ $errors->first('title') }}</li></div>@endif
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="firstNameinput" class="form-label">By</label>
                                            <input type="text" class="form-control" name="by" >
                                            @if($errors->has("by")) <div class="alert alert-danger mt-2">{{ $errors->first('by') }}</li></div>@endif
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                                    <div class="mb-3">
                                                        <label for="firstNameinput" class="form-label">Notes</label>
                                                        <textarea class="form-control" name="notes" ></textarea>
                                                        @if($errors->has("notes")) <div class="alert alert-danger mt-2">{{ $errors->first('notes') }}</li></div>@endif
                                                    </div>

                                    </div>
                                    <div class="mb-3">
                                                    </div>
                                                    <div class="mb-3">
                                                    </div>
                                                    <div class="mb-3">
                                                    </div>
                                                    <div class="mb-3">
                                                    </div>
                                                    <div class="mb-3">
                                                    </div>
                                                    <div class="mb-3">
                                                    </div>
                                                    <div class="mb-3">
                                                    </div>
                                                    <div class="mb-3">
                                                    </div>
                                                    <div class="mb-3">
                                                    </div>
                                                    <div class="mb-3">
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

            <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Recruitment History</h5>


                    </div>
                    <div class="card-body">
                    <?php foreach($interview_updates as $interview_update){
                        ?>
                        <div class="row clearfix  mb-5 ">
                            <h6 style="background:#299cdb;color:#fff;font-size:16px;padding: 10px;">{{$interview_update->title}}</h6>
                            <div class="col-sm-3 mt-2">
                            <h6 style="font-size:14px;font-weight:600">Scheduled By - </h6>
                            </div>
                            <div class="col-sm-9 mt-2">
                            <h6 style="font-size:14px;font-weight:400">{{$interview_update->scheduled_by}}</h6>
                            </div>
                            <div class="col-sm-3 mt-2">
                            <h6 style="font-size:14px;font-weight:600">Interview Time - </h6>
                            </div>
                            <div class="col-sm-9 mt-2">
                            <h6 style="font-size:14px;font-weight:400">{{$interview_update->interview_time}}</h6>
                            </div>
                            <div class="col-sm-3 mt-2">
                            <h6 style="font-size:14px;font-weight:600">Interviewer - </h6>
                            </div>
                            <div class="col-sm-9 mt-2">
                            <h6 style="font-size:14px;font-weight:400">{{$interview_update->interviewer}}</h6>
                            </div>
                            <div class="col-sm-3 mt-2">
                            <h6 style="font-size:14px;font-weight:600">Status - </h6>
                            </div>
                            <div class="col-sm-9 mt-2">
                            <h6 style="font-size:14px;font-weight:400">{{$interview_update->status}}</h6>
                            </div>
                            <div class="col-sm-3 mt-2">
                            <h6 style="font-size:14px;font-weight:600">Notes - </h6>
                            </div>
                            <div class="col-sm-9 mt-2">
                            <h6 style="font-size:14px;font-weight:400">{{$interview_update->notes}}</h6>
                            </div>
                            <div class="col-sm-12 mt-2">
                            <a href="{{ url('edit-interview-update/'.$interview_update->id) }}">
                            <button type="submit" class="btn btn-info waves-effect mt-4">
                           <span class="icon-name">EDIT</span>
                                </button>
                             </a>
                            </div>
                        </div>
                        <?php  } ?>
                        <?php foreach($other_updates as $other_update){
                        ?>
                        <div class="row clearfix  mb-5 ">
                            <h6 style="background:#299cdb;color:#fff;font-size:16px;padding: 10px;">{{$other_update->title}}</h6>
                            <div class="col-sm-3 mt-2">
                            <h6 style="font-size:14px;font-weight:600">By - </h6>
                            </div>
                            <div class="col-sm-9 mt-2">
                            <h6 style="font-size:14px;font-weight:400">{{$other_update->c_by}}</h6>
                            </div>

                            <div class="col-sm-3 mt-2">
                            <h6 style="font-size:14px;font-weight:600">Notes - </h6>
                            </div>
                            <div class="col-sm-9 mt-2">
                            <h6 style="font-size:14px;font-weight:400">{{$other_update->notes}}</h6>
                            </div>
                            <div class="col-sm-12 mt-2">
                            <a href="{{ url('edit-interview-other-update/'.$interview_update->id) }}">
                            <button type="submit" class="btn btn-info waves-effect mt-4">
                           <span class="icon-name">EDIT</span>
                                </button>
                             </a>
                             </div>
                        </div>
                        <?php  } ?>
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
$('#interview_time').datetimepicker({
  // options here
});
$("#status").select2( {
	placeholder: "Select Status",
	allowClear: true
	} );
</script>
