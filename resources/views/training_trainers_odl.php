@include('layouts.header')
<?php
use App\Models\PerformanceGoalType;
?>
<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <ul class="breadcrumb breadcrumb-style ">
                            <li class="breadcrumb-item">
                                <h4 class="page-title">Add Trainer</h4>
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
                                            <input type="text" class="form-control" name="first_name" value="{{ old('first_name') }}" required>
                                            <label class="form-label">First Name</label>
                                        </div>
                                    </div>
                                    @if($errors->has("first_name")) <div class="alert alert-danger mt-2">{{ $errors->first('first_name') }}</li></div>@endif
                        </div>
                        <div class="col-sm-3">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" required>
                                            <label class="form-label">Last Name</label>
                                        </div>
                                    </div>
                                    @if($errors->has("last_name")) <div class="alert alert-danger mt-2">{{ $errors->first('last_name') }}</li></div>@endif
                        </div>
                        <div class="col-sm-3">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                                            <label class="form-label">Email</label>
                                        </div>
                                    </div>
                                    @if($errors->has("email")) <div class="alert alert-danger mt-2">{{ $errors->first('email') }}</li></div>@endif
                        </div>
                        <div class="col-sm-3">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="phone" value="{{ old('phone') }}" required>
                                            <label class="form-label">Phone</label>
                                        </div>
                                    </div>
                                    @if($errors->has("phone")) <div class="alert alert-danger mt-2">{{ $errors->first('phone') }}</li></div>@endif
                        </div>
                        <div class="col-sm-3">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="expertise" value="{{ old('expertise') }}" required>
                                            <label class="form-label">Expertise</label>
                                        </div>
                                    </div>
                                    @if($errors->has("expertise")) <div class="alert alert-danger mt-2">{{ $errors->first('expertise') }}</li></div>@endif
                        </div>
                        <div class="col-sm-3">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="address" value="{{ old('address') }}" required>
                                            <label class="form-label">Address</label>
                                        </div>
                                    </div>
                                    @if($errors->has("address")) <div class="alert alert-danger mt-2">{{ $errors->first('address') }}</li></div>@endif
                        </div>



                                <div class="col-sm-12">
                                <button type="submit" class="btn btn-success waves-effect mt-4">

                                      ADD TRAINER

                                </button>
                                </div>

                    </div>
            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                <strong>All</strong> Goal Tracking
                            </h2>


                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover js-basic-example contact_list">
                                    <thead>
                                        <tr>
                                            <th class="">Full Name</th>
                                            <th class="">Phone</th>
                                            <th class="">E-Mail</th>
                                            <th class="">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach($trainers as $trainer){ ?>
                                        <tr class="odd gradeX">

                                            <td class="">{{$trainer->first_name.' '.$trainer->last_name}} </td>
                                            <td class="">{{$trainer->phone}}  </td>
                                            <td class="">{{$trainer->email}} </td>
                                            <td >
                                                <a href="{{ url('edit-training-trainers/'.$trainer->id) }}">
                                                <button type="button" class="btn btn-primary btn-circle waves-effect waves-circle waves-float">
                                                <i class="material-icons">create</i>
                                                </button>
                                                </a>
                                                <a href="{{ url('delete-training-trainers/'.$trainer->id) }}">
                                                <button type="button" class="btn btn-danger btn-circle waves-effect waves-circle waves-float">
                                                <i class="material-icons">delete_forever</i>
                                                </button>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                    <th class="">Full Name</th>
                                            <th class="">Phone</th>
                                            <th class="">E-Mail</th>
                                            <th class="">Actions</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@include('layouts.footer')

