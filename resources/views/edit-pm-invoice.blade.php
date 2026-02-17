@include('layouts.header')
<?php
use App\Models\PMProjects;
use App\Models\PMTaxTypes;
foreach ($invoice_details as $invoice_detail)  {
    $invoice_number = $invoice_detail->invoice_number;
    $project =$invoice_detail->project;
    $inovoice_date =$invoice_detail->inovoice_date;
    $due_date =$invoice_detail->due_date;
    $status =$invoice_detail->status;
    $invoice_note =$invoice_detail->invoice_note;
    $invoice_sub_total =$invoice_detail->invoice_sub_total;
    $discount_type =$invoice_detail->discount_type;
    $discount =$invoice_detail->discount;
    $discount_amount =$invoice_detail->discount_amount;
    $grand_total =$invoice_detail->grand_total;
    $prject_name =  PMProjects::where('id', $project)->value('title');
}

?>
?>
 <?php foreach($tax_types as $tax_type){ ?>
<input type="hidden" id="taxid{{$tax_type->id}}" value="{{$tax_type->tax_rate}}">
<?php } ?>
<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <ul class="breadcrumb breadcrumb-style ">
                            <li class="breadcrumb-item">
                                <h4 class="page-title">Edit Invoice</h4>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">

                        <div class="body">
            <form method="POST" action="" enctype="multipart/form-data">
                @csrf
                <div class="row clearfix  mt-4">
                @if(Session::has('success')) <div class="alert alert-success mb-4">{{ Session::get('success') }}</li></div>@endif
                                <div class="col-sm-3">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="invoice_number" value="{{ $invoice_number }}" required>
                                            <label class="form-label">Invoice Number</label>
                                        </div>
                                    </div>
                                    @if($errors->has("invoice_number")) <div class="alert alert-danger mt-2">{{ $errors->first('invoice_number') }}</li></div>@endif
                                </div>
                                <div class="col-sm-3">
                                <div class="mb-3">
                                <label for="formrow-email-input" class="">Project</label>
                                <select name="project" id="project" style="width:100%" required>
                                <option selected hidden value="{{$project}}">{{$prject_name}}</option>
                                <?php
                                foreach($projects as $project){
                                ?>
                                 <option value="{{$project->id}}">{{$project->title}}</option>
                                <?php } ?>
                                 </select>
                                </div>
                                @if($errors->has("project")) <div class="alert alert-danger mt-2">{{ $errors->first('project') }}</li></div>@endif
                                </div>

                                <div class="col-sm-3">
                                <div class="form-group">
                                <label class="form-label">Inovoice Date</label>
                                        <div class="form-line">
                                            <input id="myDatePicker" name="inovoice_date" class="flatPicker flatpickr-input active" placeholder="Inovoice Date" type="text" value="{{ $inovoice_date}}" required>
                                        </div>
                                    </div>
                                    @if($errors->has("inovoice_date")) <div class="alert alert-danger mt-2">{{ $errors->first('inovoice_date') }}</li></div>@endif
                                </div>
                                <div class="col-sm-3">
                                <div class="form-group">
                                <label class="form-label">Due Date</label>
                                        <div class="form-line">
                                            <input id="myDatePicker" name="due_date" class="flatPicker flatpickr-input active" placeholder="Due Date" type="text" value="{{$due_date }}" required>
                                        </div>
                                    </div>
                                    @if($errors->has("due_date")) <div class="alert alert-danger mt-2">{{ $errors->first('due_date') }}</li></div>@endif
                                </div>
                                <div class="col-sm-3">
                                <div class="form-group default-select">
                                        <div class="select-wrapper focused"><input class="select-dropdown dropdown-trigger" type="text" readonly="true" data-target="select-options-cc1ee713-46cf-5679-473b-6d23347bba08"><ul id="select-options-cc1ee713-46cf-5679-473b-6d23347bba08" class="dropdown-content select-dropdown" tabindex="0"><li id="select-options-cc1ee713-46cf-5679-473b-6d23347bba080" tabindex="0" class="selected"><span>Odsad</span></li><li id="select-options-cc1ee713-46cf-5679-473b-6d23347bba081" tabindex="0"><span>Option 2</span></li><li id="select-options-cc1ee713-46cf-5679-473b-6d23347bba082" tabindex="0"><span>Option 3</span></li><li id="select-options-cc1ee713-46cf-5679-473b-6d23347bba083" tabindex="0"><span>Option 4</span></li></ul><svg class="caret" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="M7 10l5 5 5-5z"></path><path d="M0 0h24v24H0z" fill="none"></path></svg>
                                        <select class="form-control " tabindex="-1" name="status">
                                        <option selected hidden value="{{$status}}">{{$status}}</option>
                                        <option value="paid">Paid</option>
                                        <option value="Not Paid">Not Paid</option>
                                        </select></div>
                                        @if($errors->has("status")) <div class="alert alert-danger mt-2">{{ $errors->first('status') }}</li></div>@endif
                                    </div>


                    </div>
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

                    <?php
                    $id_count = 1;
                    foreach ($invoice_items as $invoice_item)  {
                    ?>
                    <div class ="row ">
                        <div class ="col-md-2">
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" class="form-control" name="item[]"  value="{{$invoice_item->item}}"  required>
                                </div>
                        </div>
                        </div>
                        <div class ="col-md-1">
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" class="form-control"  name="qty[]" id="qty{{$id_count}}" value="{{$invoice_item->qty}}" required onKeyUp="CalItemTotal({{$id_count}});">
                                </div>
                        </div>
                        </div>
                        <div class ="col-md-2">
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" class="form-control"  name="unit_price[]" id="unit_price{{$id_count}}" value="{{$invoice_item->unit_price}}" required onKeyUp="CalItemTotal({{$id_count}});">

                            </div>
                        </div>
                        </div>
                        <div class ="col-md-2">
                        <div class="form-group default-select">
                            <div class="select-wrapper focused"><input class="select-dropdown dropdown-trigger" type="text" readonly="true" data-target="select-options-cc1ee713-46cf-5679-473b-6d23347bba08"><ul id="select-options-cc1ee713-46cf-5679-473b-6d23347bba08" class="dropdown-content select-dropdown" tabindex="0"><li id="select-options-cc1ee713-46cf-5679-473b-6d23347bba080" tabindex="0" class="selected"><span>Odsad</span></li><li id="select-options-cc1ee713-46cf-5679-473b-6d23347bba081" tabindex="0"><span>Option 2</span></li><li id="select-options-cc1ee713-46cf-5679-473b-6d23347bba082" tabindex="0"><span>Option 3</span></li><li id="select-options-cc1ee713-46cf-5679-473b-6d23347bba083" tabindex="0"><span>Option 4</span></li></ul><svg class="caret" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="M7 10l5 5 5-5z"></path><path d="M0 0h24v24H0z" fill="none"></path></svg>
                                <select class="form-control " tabindex="-1" name="tax_type[]" id="tax_type{{$id_count}}" onchange="CalItemTotal({{$id_count}});">
                                <?php if($invoice_item->tax_type  == "none") { ?>
                                <option  selected hidden value="none">No Tax</option>
                                <?php } else {
                                $tax_name =  PMTaxTypes::where('id', $invoice_item->tax_type)->value('tax_name');
                                ?>
                                <option selected hidden value="{{$invoice_item->tax_type}}">{{$tax_name}}</option>
                                <?php } ?>
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
                                <input type="text" class="form-control" id="tax_rate{{$id_count}}"  name="tax_rate[]" value="{{$invoice_item->tax_rate}}" readonly required>
                            </div>
                        </div>
                        </div>
                        <div class ="col-md-2">
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" class="form-control single-item-sub-total" name="sub_total[]" id="sub_total{{$id_count}}" value="{{$invoice_item->sub_total}}" readonly required>

                            </div>
                        </div>
                        </div>
                        </div>
                    <?php } ?>

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
                                <input type="text" class="form-control" id="sub_total_final"  name="sub_total_final" value="{{$invoice_sub_total}}" readonly required>
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
                                <option selected hidden value="{{$discount_type}}">{{$discount_type}}</option>
                                <option value="Flat">Flat</option>
                                <option value="Precent">Precent</option>
                                </select>
                            </div></td>
                                        <td><div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" class="form-control" id="discount"  name="discount" value="{{$discount}}"  required onKeyUp="CalDiscount();">
                            </div>
                        </div></td>
                                        <td><div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" class="form-control" id="discount_amount"  name="discount_amount" value="{{$discount_amount}}" readonly required>
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
                                <input type="text" class="form-control" id="grand_total"  name="grand_total" value="{{$grand_total}}" readonly required>
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
                                        <textarea id="textarea2" class="materialize-textarea" name="invoice_note" required="">{{$invoice_note}}</textarea>
                                        <label for="textarea2" class="">Invoice Note</label>
                         <span class="character-counter" style="float: right; font-size: 12px;">0</span><span class="character-counter" style="float: right; font-size: 12px;">0</span></div>

                        </div>
                        <div class="col-sm-6">

                        </div>
                        <div class="col-sm-4">

                         <button type="submit" class="btn btn-success waves-effect waves-light " id="btn_add_item">Update</button>
                        </div>
                        </div>




            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@include('layouts.footer')
<script>
$("#project").select2( {
	placeholder: "Select Project",
	allowClear: true
	} );
    $("#department").select2( {
	placeholder: "Select Department",
	allowClear: true
	} );
    $("#designation").select2( {
	placeholder: "Select Designation",
	allowClear: true
	} );
    $("#office_shift").select2( {
	placeholder: "Select Office Shift",
	allowClear: true
	} );
    $("#attendence_type").select2( {
	placeholder: "Select Attendence Type",
	allowClear: true
	} );
</script>
<script>
 $(document).ready(function(){
      var i=1000;
      $('#btn_add_item').click(function(){
           i++;
           $('#items').append('<div class="row" id="inputFormRow"><div class ="col-md-2"><div class="form-group form-float"><div class="form-line"><input type="text" class="form-control" name="item[]" required></div></div></div><div class ="col-md-1"><div class="form-group form-float"><div class="form-line"><input type="text" class="form-control" name="qty[]" id="qty'+i+'" required onKeyUp="CalItemTotal('+i+');"></div></div></div><div class ="col-md-2"><div class="form-group form-float"><div class="form-line"><input type="text" class="form-control" name="unit_price[]" id="unit_price'+i+'" required onKeyUp="CalItemTotal('+i+');"></div></div></div><div class ="col-md-2"><div class="form-group default-select"><div class="select-wrapper focused"><input class="select-dropdown dropdown-trigger" type="text" readonly="true" data-target="select-options-cc1ee713-46cf-5679-473b-6d23347bba08"><ul id="select-options-cc1ee713-46cf-5679-473b-6d23347bba08" class="dropdown-content select-dropdown" tabindex="0"><li id="select-options-cc1ee713-46cf-5679-473b-6d23347bba080" tabindex="0" class="selected"><span>Odsad</span></li><li id="select-options-cc1ee713-46cf-5679-473b-6d23347bba081" tabindex="0"><span>Option 2</span></li><li id="select-options-cc1ee713-46cf-5679-473b-6d23347bba082" tabindex="0"><span>Option 3</span></li><li id="select-options-cc1ee713-46cf-5679-473b-6d23347bba083" tabindex="0"><span>Option 4</span></li></ul><svg class="caret" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="M7 10l5 5 5-5z"></path><path d="M0 0h24v24H0z" fill="none"></path></svg><select class="form-control " tabindex="-1" name="tax_type[]" id="tax_type'+i+'" onchange="CalItemTotal('+i+');"> <option value="none">No Tax</option>  <?php foreach($tax_types as $tax_type){ ?><option value="{{$tax_type->id}}">{{$tax_type->tax_name}}</option><?php } ?></select></div></div></div><div class ="col-md-1"><div class="form-group form-float"><div class="form-line"><input type="text" class="form-control" name="tax_rate[]" id="tax_rate'+i+'" readonly required></div></div></div><div class ="col-md-2"><div class="form-group form-float"><div class="form-line"><input type="text" class="form-control single-item-sub-total" name="sub_total[]" id="sub_total'+i+'" readonly required></div></div></div><div class ="col-md-2"><button type="button" class="btn btn-danger waves-effect waves-light mt-4" id="btn_delete_item">X</button></div></div>');
      });

 });

   $(document).on('click', '#btn_delete_item', function () {
        $(this).closest('#inputFormRow').remove();
    });

function CalItemTotal(id) {
var qty = document.getElementById('qty'+id).value;
var unit_price = document.getElementById("unit_price"+id).value;
var tax_type = document.getElementById("tax_type"+id);
var tax_id = tax_type.options[tax_type.selectedIndex].value;
if(tax_id == 'none'){
var tax_value = 0;
document.getElementById("tax_rate"+id).value = tax_value+' %';
}
else{
var tax_value = document.getElementById("taxid"+tax_id).value;
document.getElementById("tax_rate"+id).value = tax_value+' %';
}

var tax_amount = (unit_price*qty)*(tax_value/100)
var sub_total = (unit_price*qty)+tax_amount;
document.getElementById("sub_total"+id).value = sub_total;

var sub_total_all = 0.0;
$('.single-item-sub-total').each(function()
{
    sub_total_all += parseFloat(this.value);
});
document.getElementById("sub_total_final").value = sub_total_all;
document.getElementById("grand_total").value = sub_total_all;
CalDiscount();
}
function CalDiscount() {
var discount = document.getElementById("discount").value;
var discount_type = document.getElementById("discount_type");
var discount_name = discount_type.options[discount_type.selectedIndex].value;
if(discount_name == 'Flat'){
var discount_amount = discount;
document.getElementById("discount_amount").value = discount_amount;
}
else{
var discount_amount = (document.getElementById("sub_total_final").value/100)*discount;
document.getElementById("discount_amount").value = discount_amount;
}

document.getElementById("grand_total").value = document.getElementById("sub_total_final").value - discount_amount;
}
</script>
