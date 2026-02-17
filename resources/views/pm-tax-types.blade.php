@include('layouts.header')
<?php
use App\Models\OtherEmployeeDetails;
?>
<div class="main-content">

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0" style="display: none;">Tax Types</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                            <li class="breadcrumb-item active">Tax Types</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->



        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0" style="font-size: 24px; color: rgb(7, 7, 7); font-weight: 500; margin-left: 20px;">Tax Types</h5>
                        <a href="{{url('add-tax-type')}}"><button type="button" class="mt-4 btn btn-info">Add Tax Types</button></a>
                        @if(Session::has('success')) <div class="alert alert-success mt-4">{{ Session::get('success') }}</div>@endif
                    </div>
                    <div class="card-body">
                        <table id="buttons-datatables" class="display table table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                <th class="">Tax Name</th>
                                            <th class="">Tax Rate</th>
                                            <th class="">Tax Type</th>
                                            <th class="">Discription</th>
                                            <th class=""> Action </th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach($tax_types as $tax_type){
                                   ?>
                                        <tr class="odd gradeX">

                                            <td class="">{{$tax_type->tax_name}} </td>
                                            <td class="">{{$tax_type->tax_rate}}  </td>
                                            <td class="">{{$tax_type->tax_type}} </td>
                                            <td class="">{{$tax_type->discription}} </td>
                                            <td >
                                                <a href="{{ url('edit-pm-tax-type/'.$tax_type->id) }}">
                                                <i class="ri-pencil-fill"></i>
                                                </a>
                                                <a href="{{ url('delete-pm-tax-type/'.$tax_type->id) }}">
                                                <i class="ri-delete-bin-fill"></i>
                                                </a>

                                            </td>
                                        </tr>
                                    <?php } ?>
                            </tbody>
                        </table>
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
$("#company").select2( {
	placeholder: "Select Company",
	allowClear: true
	} );
    $("#employee").select2( {
	placeholder: "Select Employee",
	allowClear: true
	} );
    $("#department").select2( {
	placeholder: "Select Department",
	allowClear: true
	} );
    $("#award_type").select2( {
	placeholder: "Select Award Type",
	allowClear: true
	} );
</script>
