@include('layouts.header')
<?php

foreach ($contact_details as $contact_detail)  {
    $relation = $contact_detail->relation;
    $email_work =$contact_detail->email_work;
    $email_personal =$contact_detail->email_personal;
    $name =$contact_detail->name;
    $address_line1 =$contact_detail->address_line1;
    $address_line2 =$contact_detail->address_line2;
    $mobile_work =$contact_detail->mobile_work;
    $mobile_ext =$contact_detail->mobile_ext;
    $mobile_personal =$contact_detail->mobile_personal;
    $mobile_home =$contact_detail->mobile_home;
    $city =$contact_detail->city;
    $state_province =$contact_detail->state_province;
    $zip =$contact_detail->mobile_personal;
    $country =$contact_detail->country;

}
?>
<div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0">Edit Contact</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                        <li class="breadcrumb-item active">Edit Contact</li>
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
                                    <h4 class="card-title mb-0 flex-grow-1">Edit Contact</h4>

                                </div><!-- end card header -->

                                <form  action="" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                <div class="d-flex flex-wrap gap-2 mb-4">
                                <button type="submit" class="btn btn-info">Save Contact</button>

                                </div>
                                @if(Session::has('success')) <div class="alert alert-success mb-4">{{ Session::get('success') }}</div>@endif
                                    <div class="live-preview">

                                            <div class="row">
                                            <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="firstNameinput" class="form-label">Relation</label>
                                                        <select class="form-control" data-choices  id="choices-single-default" name="relation" >
                                                        <option selected hidden  value="{{$relation}}">{{$relation}}</option>
                                                        <option value="Self">Self</option>
                                 <option value="Parent">Parent</option>
                                 <option value="Spouse">Spouse</option>
                                <option value="Child">Child</option>
                                <option value="Sibling">Sibling</option>
                                <option value="In Laws">In Laws</option>
                                                        </select>
                                                        @if($errors->has("relation")) <div class="alert alert-danger mt-2">{{ $errors->first('relation') }}</li></div>@endif
                                                    </div>
                                                </div>
                                                <!--end col-->

                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="firstNameinput" class="form-label">E-Mail Work</label>
                                                        <input type="email" class="form-control" name="email_work" value="{{$email_work}}">
                                                        @if($errors->has("email_work")) <div class="alert alert-danger mt-2">{{ $errors->first('email_work') }}</li></div>@endif
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="firstNameinput" class="form-label">E-Mail Personal</label>
                                                        <input type="email" class="form-control" name="email_personal" value="{{$email_personal}}">
                                                        @if($errors->has("email_personal")) <div class="alert alert-danger mt-2">{{ $errors->first('email_personal') }}</li></div>@endif
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="firstNameinput" class="form-label">Name</label>
                                                        <input type="text" class="form-control" name="name" value="{{$name}}">
                                                        @if($errors->has("name")) <div class="alert alert-danger mt-2">{{ $errors->first('name') }}</li></div>@endif
                                                    </div>
                                                </div>
                                                <!--end col-->
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="firstNameinput" class="form-label">Address Line 1</label>
                                                        <input type="text" class="form-control" name="address_line1" value="{{$address_line1}}">
                                                        @if($errors->has("address_line1")) <div class="alert alert-danger mt-2">{{ $errors->first('address_line1') }}</li></div>@endif
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="firstNameinput" class="form-label">Address Line 2</label>
                                                        <input type="text" class="form-control" name="address_line2" value="{{$address_line2}}">
                                                        @if($errors->has("address_line2")) <div class="alert alert-danger mt-2">{{ $errors->first('address_line2') }}</li></div>@endif
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="firstNameinput" class="form-label">Mobile Work</label>
                                                        <input type="text" class="form-control" name="mobile_work" value="{{$mobile_work}}">
                                                        @if($errors->has("mobile_work")) <div class="alert alert-danger mt-2">{{ $errors->first('mobile_work') }}</li></div>@endif
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="firstNameinput" class="form-label">Mobile Ext</label>
                                                        <input type="text" class="form-control" name="mobile_ext" value="{{$mobile_ext}}">
                                                        @if($errors->has("mobile_ext")) <div class="alert alert-danger mt-2">{{ $errors->first('mobile_ext') }}</li></div>@endif
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="firstNameinput" class="form-label">Mobile Personal</label>
                                                        <input type="text" class="form-control" name="mobile_personal" value="{{$mobile_personal}}">
                                                        @if($errors->has("mobile_personal")) <div class="alert alert-danger mt-2">{{ $errors->first('mobile_personal') }}</li></div>@endif
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="firstNameinput" class="form-label">Mobile Home</label>
                                                        <input type="text" class="form-control" name="mobile_home" value="{{$mobile_home}}">
                                                        @if($errors->has("mobile_home")) <div class="alert alert-danger mt-2">{{ $errors->first('mobile_home') }}</li></div>@endif
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="firstNameinput" class="form-label">City</label>
                                                        <input type="text" class="form-control" name="city" value="{{$city}}">
                                                        @if($errors->has("city")) <div class="alert alert-danger mt-2">{{ $errors->first('city') }}</li></div>@endif
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="firstNameinput" class="form-label">State/Province</label>
                                                        <input type="text" class="form-control" name="state_province" value="{{$state_province}}">
                                                        @if($errors->has("state_province")) <div class="alert alert-danger mt-2">{{ $errors->first('state_province') }}</li></div>@endif
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="firstNameinput" class="form-label">ZIP</label>
                                                        <input type="text" class="form-control" name="zip" value="{{$zip}}">
                                                        @if($errors->has("zip")) <div class="alert alert-danger mt-2">{{ $errors->first('zip') }}</li></div>@endif
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="firstNameinput" class="form-label">Country</label>
                                                        <select class="form-control" data-choices  id="choices-single-default" name="country" >
                                                        <option selected hidden  value="{{$country}}">{{$country}}</option>
                                                        <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                                        </select>
                                                        @if($errors->has("country")) <div class="alert alert-danger mt-2">{{ $errors->first('country') }}</li></div>@endif
                                                    </div>
                                                </div>
                                                <!--end col-->
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
