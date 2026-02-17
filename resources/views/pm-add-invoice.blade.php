<?php
use App\Models\Designations;
use App\Models\Departments;
?>
@include('layouts.header')
<?php foreach($tax_types as $tax_type){ ?>
    <input type="hidden" id="taxid{{$tax_type->id}}" value="{{$tax_type->tax_rate}}">
    <?php } ?>
<div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0">Add Invoice</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                        <li class="breadcrumb-item active">Add Invoice</li>
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
                                    <h4 class="card-title mb-0 flex-grow-1">Add Invoice</h4>

                                </div><!-- end card header -->

                                <form  action="" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                <div class="d-flex flex-wrap gap-2 mb-4">
                                <button type="submit" class="btn btn-info">Save File</button>
                                <a href="{{url('pm-invoices')}}"><button type="button" class="btn btn-light">Back</button></a>
                                </div>
                                @if(Session::has('success')) <div class="alert alert-success mb-4">{{ Session::get('success') }}</div>@endif
                                    <div class="live-preview">

                                            <div class="row">


                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="firstNameinput" class="form-label">Invoice Number</label>
                                                        <input type="text" class="form-control" name="file_name" value="{{ old('invoice_number') }}">
                                                        @if($errors->has("invoice_number")) <div class="alert alert-danger mt-2">{{ $errors->first('invoice_number') }}</li></div>@endif
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="firstNameinput" class="form-label">Project</label>
                                                        <select class="form-control" data-choices  id="choices-single-default" name="project" >
                                                            <?php
                                                            foreach($projects as $project){
                                                            ?>
                                                             <option value="{{$project->id}}">{{$project->title}}</option>
                                                            <?php } ?>
                                                        </select>
                                                        @if($errors->has("project")) <div class="alert alert-danger mt-2">{{ $errors->first('project') }}</li></div>@endif
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="firstNameinput" class="form-label">Invoice Date</label>
                                                        <input name="inovoice_date" value="{{  old('inovoice_date') }}" type="text" class="form-control flatpickr-input active" data-provider="flatpickr" data-date-format="n/j/Y" readonly="readonly" >
                                                        @if($errors->has("inovoice_date")) <div class="alert alert-danger mt-2">{{ $errors->first('inovoice_date') }}</li></div>@endif
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="firstNameinput" class="form-label">Due Date</label>
                                                        <input name="due_date" value="{{  old('due_date') }}" type="text" class="form-control flatpickr-input active" data-provider="flatpickr" data-date-format="n/j/Y" readonly="readonly" >
                                                        @if($errors->has("due_date")) <div class="alert alert-danger mt-2">{{ $errors->first('due_date') }}</li></div>@endif
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="firstNameinput" class="form-label">status</label>
                                                        <select class="form-control" data-choices  id="choices-single-default" name="status" >
                                                            <option value="paid">Paid</option>
                                                            <option value="Not Paid">Not Paid</option>
                                                        </select>
                                                        @if($errors->has("status")) <div class="alert alert-danger mt-2">{{ $errors->first('status') }}</li></div>@endif
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end row-->
                                            <hr>
                    <div class ="row mt-4">
                    <div class ="col-md-2">
                    <div class="header">
                            <h2><strong>ITEM</strong></h2>
                    </div>
                    </div>
                    <div class ="col-md-1">
                    <div class="header">
                            <h2><strong>QTY</strong></h2>
                    </div>
                    </div>
                    <div class ="col-md-2">
                    <div class="header">
                            <h2><strong>UNIT PRICE</strong></h2>
                    </div>
                    </div>
                    <div class ="col-md-2">
                    <div class="header">
                            <h2><strong>TAX TYPE</strong></h2>
                    </div>
                    </div>
                    <div class ="col-md-1">
                    <div class="header">
                            <h2><strong>TAX Rate</strong></h2>
                    </div>
                    </div>
                    <div class ="col-md-2">
                    <div class="header">
                            <h2><strong>Sub Total</strong></h2>
                    </div>
                    </div>
                    </div>
                    <div class ="row ">
                        <div class ="col-md-2">
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" class="form-control" name="item[]"  required>
                                </div>
                        </div>
                        </div>
                        <div class ="col-md-1">
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" class="form-control"  name="qty[]" id="qty1" required onKeyUp="CalItemTotal(1);">
                                </div>
                        </div>
                        </div>
                        <div class ="col-md-2">
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" class="form-control"  name="unit_price[]" id="unit_price1" required onKeyUp="CalItemTotal(1);">

                            </div>
                        </div>
                        </div>
                        <div class ="col-md-2">
                        <div class="form-group default-select">
                            <div class="select-wrapper focused"><input class="select-dropdown dropdown-trigger" type="text" readonly="true" data-target="select-options-cc1ee713-46cf-5679-473b-6d23347bba08"><ul id="select-options-cc1ee713-46cf-5679-473b-6d23347bba08" class="dropdown-content select-dropdown" tabindex="0"><li id="select-options-cc1ee713-46cf-5679-473b-6d23347bba080" tabindex="0" class="selected"><span>Odsad</span></li><li id="select-options-cc1ee713-46cf-5679-473b-6d23347bba081" tabindex="0"><span>Option 2</span></li><li id="select-options-cc1ee713-46cf-5679-473b-6d23347bba082" tabindex="0"><span>Option 3</span></li><li id="select-options-cc1ee713-46cf-5679-473b-6d23347bba083" tabindex="0"><span>Option 4</span></li></ul><svg class="caret" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="M7 10l5 5 5-5z"></path><path d="M0 0h24v24H0z" fill="none"></path></svg>
                                <select class="form-control " tabindex="-1" name="tax_type[]" id="tax_type1" onchange="CalItemTotal(1);">
                                <option value="none">No Tax</option>
                                <?php
                                foreach($tax_types as $tax_type){
                                ?>
                                 <option value="{{$tax_type->id}}">{{$tax_type->tax_name.' ('.$tax_type->tax_rate.'%)'}}</option>
                                <?php } ?>
                                </select>
                            </div>
                            </div>
                        </div>
                        <div class ="col-md-1">
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" class="form-control" id="tax_rate1"  name="tax_rate[]" value="0 %" readonly required>
                            </div>
                        </div>
                        </div>
                        <div class ="col-md-2">
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" class="form-control single-item-sub-total" name="sub_total[]" id="sub_total1" readonly required>

                            </div>
                        </div>
                        </div>
                        </div>

                        <div id="items">
                        </div>

                        <div class="row">
                        <div class="col-md-3">
                        <div class="mb-3 mt-4">
                        <button type="button" class="btn btn-primary waves-effect waves-light " id="btn_add_item">
                        <i class="dripicons-plus font-size-16 align-middle me-2"></i>Add More Items</button>
                        </div>
                        </div>
                        </div>
                        <div class="row">
                        <div class="col-md-6">

                        </div>
                        <div class="col-md-4">
                        <div class="body table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>

                                        <th>Sub Total</th>
                                        <th> <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" class="form-control" id="sub_total_final"  name="sub_total_final" value="0" readonly required>
                            </div>
                        </div></th>

                                    </tr>
                                </thead>
                            </table>
                        </div>
                        <div class="body table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>

                                        <th>Discount Type</th>
                                        <th>Discount</th>
                                        <th>Discount Amount</th>
                                    </tr>
                                    <tr>

                                        <td> <div class="form-group default-select">
                            <div class="select-wrapper focused"><input class="select-dropdown dropdown-trigger" type="text" readonly="true" data-target="select-options-cc1ee713-46cf-5679-473b-6d23347bba08"><ul id="select-options-cc1ee713-46cf-5679-473b-6d23347bba08" class="dropdown-content select-dropdown" tabindex="0"><li id="select-options-cc1ee713-46cf-5679-473b-6d23347bba080" tabindex="0" class="selected"><span>Odsad</span></li><li id="select-options-cc1ee713-46cf-5679-473b-6d23347bba081" tabindex="0"><span>Option 2</span></li><li id="select-options-cc1ee713-46cf-5679-473b-6d23347bba082" tabindex="0"><span>Option 3</span></li><li id="select-options-cc1ee713-46cf-5679-473b-6d23347bba083" tabindex="0"><span>Option 4</span></li></ul><svg class="caret" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="M7 10l5 5 5-5z"></path><path d="M0 0h24v24H0z" fill="none"></path></svg>
                                <select class="form-control " tabindex="-1" name="discount_type" id="discount_type" onchange="CalDiscount();">
                                <option value="Flat">Flat</option>
                                <option value="Precent">Precent</option>
                                </select>
                            </div></td>
                                        <td><div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" class="form-control" id="discount"  name="discount" value="0"  required onKeyUp="CalDiscount();">
                            </div>
                        </div></td>
                                        <td><div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" class="form-control" id="discount_amount"  name="discount_amount" value="0" readonly required>
                            </div>
                        </div></td>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        <div class="body table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>

                                        <th>Grand Total</th>
                                        <th> <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" class="form-control" id="grand_total"  name="grand_total" value="0" readonly required>
                            </div>
                        </div></th>

                                    </tr>
                                </thead>
                            </table>
                        </div>
                        </div>
                        <div class="row">
                        <div class="col-sm-6">
                         <div class="input-field col s12" style="margin-top:unset;margin-bottom:unset;">
                                        <textarea id="textarea2" class="materialize-textarea" name="invoice_note" required=""></textarea>
                                        <label for="textarea2" class="">Invoice Note</label>
                         <span class="character-counter" style="float: right; font-size: 12px;">0</span><span class="character-counter" style="float: right; font-size: 12px;">0</span></div>

                        </div>
                        <div class="col-sm-6">

                        </div>
                       
                        </div>
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
