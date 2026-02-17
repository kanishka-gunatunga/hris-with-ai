@include('layouts.header')
<?php

foreach ($interview_details as $interview_detail)  {
    $title = $interview_detail->title;
    $by =$interview_detail->c_by;
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
                                <h4 class="mb-sm-0">Edit Interview Other Update</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                        <li class="breadcrumb-item active">Edit Interview Other Update</li>
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
                                    <h4 class="card-title mb-0 flex-grow-1">Edit Interview Other Update</h4>

                                </div><!-- end card header -->

                                <form method="POST" action="" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                <div class="d-flex flex-wrap gap-2 mb-4">
                                <button type="submit" class="btn btn-info">Save Interview Other Update</button>
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
                                            <label for="firstNameinput" class="form-label">By</label>
                                            <input type="text" class="form-control" name="by" value="{{$by}}">
                                            @if($errors->has("by")) <div class="alert alert-danger mt-2">{{ $errors->first('by') }}</li></div>@endif
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
