@include('layouts.header')
<?php
use App\Models\PerformanceGoalType;
?>
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="mb-sm-0 dashboard-title">Trainers</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Trainers</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xxl-12">
                    <div class="card-theme">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="card-title mb-0">Add Trainer</h5>
                        </div><!-- end card header -->

                        <form action="" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">

                                @if(Session::has('success'))
                                <div class="alert alert-success mb-4">{{ Session::get('success') }}</div>@endif
                                <div class="live-preview">

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="firstNameinput" class="form-label">First Name</label>
                                                <input type="text" class="form-control" name="first_name"
                                                    value="{{ old('first_name') }}">
                                                @if($errors->has("first_name"))
                                                    <div class="alert alert-danger mt-2">{{ $errors->first('first_name') }}
                                                        </li>
                                                </div>@endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="firstNameinput" class="form-label">Last Name</label>
                                                <input type="text" class="form-control" name="last_name"
                                                    value="{{ old('last_name') }}">
                                                @if($errors->has("last_name"))
                                                    <div class="alert alert-danger mt-2">{{ $errors->first('last_name') }}
                                                        </li>
                                                </div>@endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="firstNameinput" class="form-label">Email</label>
                                                <input type="email" class="form-control" name="email"
                                                    value="{{ old('email') }}">
                                                @if($errors->has("email"))
                                                    <div class="alert alert-danger mt-2">{{ $errors->first('email') }}</li>
                                                </div>@endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="firstNameinput" class="form-label">Phone</label>
                                                <input type="text" class="form-control" name="phone"
                                                    value="{{ old('phone') }}">
                                                @if($errors->has("phone"))
                                                    <div class="alert alert-danger mt-2">{{ $errors->first('phone') }}</li>
                                                </div>@endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="firstNameinput" class="form-label">Expertise</label>
                                                <input type="text" class="form-control" name="expertise"
                                                    value="{{ old('expertise') }}">
                                                @if($errors->has("expertise"))
                                                    <div class="alert alert-danger mt-2">{{ $errors->first('expertise') }}
                                                        </li>
                                                </div>@endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="firstNameinput" class="form-label">Address</label>
                                                <input type="text" class="form-control" name="address"
                                                    value="{{ old('address') }}">
                                                @if($errors->has("address"))
                                                    <div class="alert alert-danger mt-2">{{ $errors->first('address') }}
                                                        </li>
                                                </div>@endif
                                            </div>
                                        </div>
                                    </div>
                                    <!--end row-->
                                    <div class="d-flex flex-wrap gap-2 mb-4">
                                        <button type="submit" class="btn btn-theme-orange">Save Trainer</button>
                                    </div>
                                </div>
                        </form>

                    </div>
                </div>
            </div> <!-- end col -->

        </div>


        <div class="row">
            <div class="col-lg-12">
                <div class="card-theme">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Trainers</h5>

                    </div>
                    <div class="card-body p-0">
                        <style>
                            #buttons-datatables_wrapper {
                                padding: 20px;
                            }

                            .konnect-table-wrapper {
                                overflow-x: auto !important;
                            }
                        </style>
                        <div class="konnect-table-wrapper">
                            <table id="buttons-datatables" class="display table konnect-table mb-0" style="width:100%">
                                <thead>
                                    <tr>
                                        <th class="ps-4">Full Name</th>
                                        <th class="">Phone</th>
                                        <th class="">E-Mail</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php foreach ($trainers as $trainer) { ?>
                                    <tr>

                                        <td class="ps-4">{{$trainer->first_name . ' ' . $trainer->last_name}} </td>
                                        <td class="">{{$trainer->phone}} </td>
                                        <td class="">{{$trainer->email}} </td>
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center gap-2">
                                                <a href="{{ url('edit-training-trainers/' . $trainer->id) }}"
                                                    class="btn-icon-soft-blue" title="Edit">
                                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path
                                                            d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7">
                                                        </path>
                                                        <path
                                                            d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z">
                                                        </path>
                                                    </svg>
                                                </a>
                                                <a href="{{ url('delete-training-trainers/' . $trainer->id) }}"
                                                    class="btn-icon-soft-red" title="Delete">
                                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <polyline points="3 6 5 6 21 6"></polyline>
                                                        <path
                                                            d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                        </path>
                                                    </svg>
                                                </a>
                                            </div>
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




    </div>
    <!-- container-fluid -->
</div>
<!-- End Page-content -->
@include('layouts.footer')