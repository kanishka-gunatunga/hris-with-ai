@include('layouts.header')
<?php
use App\Models\PMProjects;
?>
<div class="main-content">

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0" style="display: none;">Invoices</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                            <li class="breadcrumb-item active">Invoices</li>
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
                        <h5 class="card-title mb-0" style="font-size: 24px; color: rgb(7, 7, 7); font-weight: 500; margin-left: 20px;">Invoices</h5>
                        <a href="{{url('pm-add-invoice')}}"><button type="button" class="mt-4 btn btn-info">Add Invoice</button></a>
                        @if(Session::has('success')) <div class="alert alert-success mt-4">{{ Session::get('success') }}</div>@endif
                    </div>
                    <div class="card-body">
                        <table id="buttons-datatables" class="display table table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                <th class="">Invoice No</th>
                                            <th class=""> Project </th>
                                            <th class=""> Total </th>
                                            <th class=""> Invocie Date </th>
                                            <th class="">Due Date</th>
                                            <th class="">Status</th>
                                            <th class=""> Action </th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach($invoices as $invoice){
                                    $prject_name =  PMProjects::where('id', $invoice->project)->value('title');

                                    ?>
                                        <tr class="odd gradeX">

                                            <td >{{$invoice->invoice_number}}</td>
                                            <td >{{$prject_name}}</td>
                                            <td >{{$invoice->grand_total}}</td>
                                            <td >{{$invoice->inovoice_date}}</td>
                                            <td>{{$invoice->due_date}}</td>
                                            <td >
                                            <?php
                                            if($invoice->status == "Paid"){ ?>
                                            <span class="label label-success">Paid</span>
                                            <?php }
                                            else{ ?>
                                            <span class="label label-danger">Not Paid</span>
                                            <?php }
                                            ?>
                                            </td>
                                            <td >
                                                <a href="{{ url('edit-pm-invoice/'.$invoice->id) }}">
                                                <i class="ri-pencil-fill"></i>
                                                </a>
                                                <a href="{{ url('delete-pm-invoice/'.$invoice->id) }}">
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
