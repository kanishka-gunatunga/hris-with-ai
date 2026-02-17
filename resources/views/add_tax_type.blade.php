
@include('layouts.header')
<div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0"style="display: none;">Add Tax Type</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                        <li class="breadcrumb-item active">Add Tax Type</li>
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
                                    <div class="vertical-center-heading">
                                    <h4 class="card-title mb-0 flex-grow-1"style="font-size: 24px; color: rgb(7, 7, 7); font-weight: 500; margin-left: 20px; margin-top: 20px; margin-bottom: 20px;"
                                    >Add Tax Type</h4>
                                </div>
                                </div><!-- end card header -->

                                <form  action="" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                <div class="d-flex flex-wrap gap-2 mb-4">
                                <button type="submit" class="btn btn-info">Save Tax Type</button>
                                <a href="{{url('pm-tax-types')}}"><button type="button" class="btn btn-light">Back</button></a>
                                </div>
                                @if(Session::has('success')) <div class="alert alert-success mb-4">{{ Session::get('success') }}</div>@endif
                                    <div class="live-preview">

                                            <div class="row">
                                            <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="firstNameinput" class="form-label">Tax Name</label>
                                                        <input type="text" class="form-control" name="tax_name" value="{{ old('tax_name') }}">
                                                        @if($errors->has("tax_name")) <div class="alert alert-danger mt-2">{{ $errors->first('tax_name') }}</li></div>@endif
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="firstNameinput" class="form-label">Tax Rate</label>
                                                        <input type="text" class="form-control" name="tax_rate" value="{{ old('tax_rate')  }}">
                                                        @if($errors->has("tax_rate")) <div class="alert alert-danger mt-2">{{ $errors->first('tax_rate') }}</li></div>@endif
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="firstNameinput" class="form-label">Description</label>
                                                        <textarea class="form-control" name="discription" >{{ old('discription') }}</textarea>
                                                        @if($errors->has("discription")) <div class="alert alert-danger mt-2">{{ $errors->first('discription') }}</li></div>@endif
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="firstNameinput" class="form-label">Tax Type</label>
                                                        <select class="form-control" data-choices  id="choices-single-default" name="tax_type" >
                                                        
                                 <option value="Fixed">Fixed</option>
                                 <option value="Precentage">Precentage</option>
                                                        </select>
                                                        @if($errors->has("tax_type")) <div class="alert alert-danger mt-2">{{ $errors->first('tax_type') }}</li></div>@endif
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
<script>

    $('#discription').summernote({
        tabsize: 2,
        height: 200
      });

</script>
