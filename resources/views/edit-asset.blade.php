<?php
use App\Models\AssetCategory;
use App\Models\OtherEmployeeDetails;

foreach ($asset_details as $asset_detail)  {
    $asset_name = $asset_detail->asset_name;
    $asset_code =$asset_detail->asset_code;
    $category =$asset_detail->category;
    $is_working =$asset_detail->is_working;
    $employee = $asset_detail->employee;
    $purchase_date =$asset_detail->purchase_date;
    $end_date =$asset_detail->end_date;
    $manufacturer =$asset_detail->manufacturer;
    $invoice_number = $asset_detail->invoice_number;
    $serial_number =$asset_detail->serial_number;
    $asset_note =$asset_detail->asset_note;
    $employee_name =OtherEmployeeDetails::where('user_id', $employee)->value('first_name').' '.OtherEmployeeDetails::where('user_id', $employee)->value('last_name');
    $category_name =AssetCategory::where('id', $category)->value('category');
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
                                <h4 class="mb-sm-0">Edit Asset</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                        <li class="breadcrumb-item active">Edit Asset</li>
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
                                    <h4 class="card-title mb-0 flex-grow-1">Edit Asset</h4>

                                </div><!-- end card header -->

                                <form  action="" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                <div class="d-flex flex-wrap gap-2 mb-4">
                                <button type="submit" class="btn btn-info">Save Asset</button>
                                <a href="{{url('assets-page')}}"><button type="button" class="btn btn-light">Back</button></a>
                                </div>
                                @if(Session::has('success')) <div class="alert alert-success mb-4">{{ Session::get('success') }}</div>@endif
                                    <div class="live-preview">

                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="firstNameinput" class="form-label">Asset Name</label>
                                                        <input type="text" class="form-control" name="asset_name" value="{{ $asset_name }}">
                                                        @if($errors->has("asset_name")) <div class="alert alert-danger mt-2">{{ $errors->first('asset_name') }}</li></div>@endif
                                                    </div>
                                                </div>
                                                <!--end col-->
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="firstNameinput" class="form-label">Asset Code</label>
                                                        <input type="text" class="form-control" name="asset_code" value="{{ $asset_code }}">
                                                        @if($errors->has("asset_code")) <div class="alert alert-danger mt-2">{{ $errors->first('asset_code') }}</li></div>@endif
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="firstNameinput" class="form-label">Category</label>
                                                        <select class="form-control" data-choices  id="choices-single-default" name="category" >
                                                        <option selected hidden value="{{$category}}">{{$category_name}}</option>
                                                        <?php
                                foreach($categorys as $category){
                                ?>
                                 <option value="{{$category->id}}">{{$category->category}}</option>
                                <?php } ?>
                                                        </select>
                                                        @if($errors->has("category")) <div class="alert alert-danger mt-2">{{ $errors->first('category') }}</li></div>@endif
                                                    </div>
                                                </div>
                                                <!--end col-->
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="firstNameinput" class="form-label">Is Working</label>
                                                        <select class="form-control" data-choices  id="choices-single-default" name="is_working" >
                                                        <option selected hidden value="{{$is_working}}">{{$is_working}}</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="On Maintence">On Maintence</option>
                                                        </select>
                                                        @if($errors->has("is_working")) <div class="alert alert-danger mt-2">{{ $errors->first('is_working') }}</li></div>@endif
                                                    </div>
                                                </div>
                                                <!--end col-->
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="firstNameinput" class="form-label">Employee</label>
                                                        <select class="form-control" data-choices id="choices-single-default" name="employee" >
                                                        <option selected hidden value="{{$employee}}">{{$employee_name}}</option>
                                                        <?php
                                foreach($employees as $employee){
                                ?>
                                 <option value="{{$employee->user_id}}">{{$employee->first_name.' '.$employee->last_name}}</option>
                                <?php } ?>
                                                        </select>
                                                        @if($errors->has("employee")) <div class="alert alert-danger mt-2">{{ $errors->first('employee') }}</li></div>@endif
                                                    </div>
                                                </div>
                                                <!--end col-->
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="firstNameinput" class="form-label">Purchase Date</label>
                                                        <input name="purchase_date" value="{{ $purchase_date }}" type="text" class="form-control flatpickr-input active" data-provider="flatpickr" data-date-format="n/j/Y" readonly="readonly" >
                                                        @if($errors->has("purchase_date")) <div class="alert alert-danger mt-2">{{ $errors->first('purchase_date') }}</li></div>@endif
                                                    </div>
                                                </div>
                                                <!--end col-->
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="firstNameinput" class="form-label">Warranty/AMC End Date</label>
                                                        <input name="end_date" value="{{ $end_date }}" type="text" class="form-control flatpickr-input active" data-provider="flatpickr" data-date-format="n/j/Y" readonly="readonly" >
                                                        @if($errors->has("end_date")) <div class="alert alert-danger mt-2">{{ $errors->first('end_date') }}</li></div>@endif
                                                    </div>
                                                </div>
                                                <!--end col-->
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="firstNameinput" class="form-label">Manufacturer</label>
                                                        <input type="text" class="form-control" name="manufacturer" value="{{ $manufacturer }}">
                                                        @if($errors->has("manufacturer")) <div class="alert alert-danger mt-2">{{ $errors->first('manufacturer') }}</li></div>@endif
                                                    </div>
                                                </div>
                                                <!--end col-->

                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="firstNameinput" class="form-label">Invoice Number</label>
                                                        <input type="text" class="form-control" name="invoice_number" value="{{$invoice_number }}">
                                                        @if($errors->has("invoice_number")) <div class="alert alert-danger mt-2">{{ $errors->first('invoice_number') }}</li></div>@endif
                                                    </div>
                                                </div>
                                                <!--end col-->
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="firstNameinput" class="form-label">Serial Number</label>
                                                        <input type="text" class="form-control" name="serial_number" value="{{ $serial_number }}">
                                                        @if($errors->has("serial_number")) <div class="alert alert-danger mt-2">{{ $errors->first('serial_number') }}</li></div>@endif
                                                    </div>
                                                </div>
                                                <!--end col-->
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="firstNameinput" class="form-label">Assets Image</label>
                                                        <input type="file" class="form-control" name="image" >
                                                        @if($errors->has("image")) <div class="alert alert-danger mt-2">{{ $errors->first('image') }}</li></div>@endif
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="mb-3">
                                                        <label for="firstNameinput" class="form-label">Asset Note</label>
                                                        <textarea id="asset_note" name="asset_note"><?php echo $asset_note; ?></textarea>
                                                        @if($errors->has("asset_note")) <div class="alert alert-danger mt-2">{{ $errors->first('asset_note') }}</li></div>@endif
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
