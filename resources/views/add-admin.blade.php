@include('layouts.header')
<link href="{{ asset('assets/css/custom-dropdown.css') }}" rel="stylesheet" type="text/css" />

<div class="main-content">

    <div class="page-content pb-10">
        <div class="container-fluid mb-10">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="mb-sm-0 dashboard-title">Add Admin</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Add Admin</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xxl-12">
                    <form action="" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card card-theme shadow-none rounded-3 border-0"
                            style="overflow: visible !important;">
                            <div class="card-header border-0 bg-white p-4">
                                <h4 class="card-title mb-0 dashboard-title">Admin Details</h4>
                            </div>

                            <div class="card-body p-4 pt-0" style="overflow: visible !important;">
                                @if (Session::has('success'))
                                    <div class="alert alert-success mt-2 mb-4">{{ Session::get('success') }}</div>
                                @endif

                                <div class="live-preview">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">First Name</label>
                                                <input type="text" class="form-control" name="first_name"
                                                    value="{{ old('first_name') }}">
                                                @if ($errors->has('first_name'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('first_name') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Last Name</label>
                                                <input type="text" class="form-control" name="last_name"
                                                    value="{{ old('last_name') }}">
                                                @if ($errors->has('last_name'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('last_name') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Phone
                                                    Number</label>
                                                <input type="text" class="form-control" name="phone"
                                                    value="{{ old('phone') }}">
                                                @if ($errors->has('phone'))
                                                    <div class="alert alert-danger mt-2">{{ $errors->first('phone') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <!--end col-->

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">E-Mail</label>
                                                <input type="email" class="form-control" name="email"
                                                    value="{{ old('email') }}">
                                                @if ($errors->has('email'))
                                                    <div class="alert alert-danger mt-2">{{ $errors->first('email') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">User Name</label>
                                                <input type="text" class="form-control" name="user_name"
                                                    value="{{ old('user_name') }}">
                                                @if ($errors->has('user_name'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('user_name') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Password</label>
                                                <input type="password" class="form-control" name="password"
                                                    value="{{ old('password') }}">
                                                @if ($errors->has('password'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('password') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <!--end col-->
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Confirm
                                                    Password</label>
                                                <input type="password" class="form-control" name="password_confirmation"
                                                    value="{{ old('password_confirmation') }}">
                                                @if ($errors->has('password_confirmation'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('password_confirmation') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Image</label>
                                                <input type="file" class="form-control" name="image">
                                                @if ($errors->has('image'))
                                                    <div class="alert alert-danger mt-2">{{ $errors->first('image') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-check mb-3">
                                                <input class="form-check-input orange-checked" type="checkbox"
                                                    id="formCheck6" checked="checked" name="status">
                                                <label class="form-check-label text-[#556476] font-medium"
                                                    for="formCheck6">
                                                    Active Admin
                                                </label>
                                            </div>
                                        </div>
                                        <!--end col-->

                                        <!--end col-->
                                    </div>
                                    <!--end row-->
                                </div>
                            </div>
                        </div> <!-- end card -->

                        <div class="fixed-bottom bg-white border-top p-3 d-flex justify-content-between align-items-center"
                            style="z-index: 1001; margin-left: 250px;">
                            <button type="button" class="btn btn-outline-secondary px-4 py-2 action-btn-back"
                                style="color: #556476; border-color: #556476;"
                                onclick="window.location.href='{{ url('admins') }}'">Back</button>
                            <button type="submit" class="btn btn-theme-orange px-5 py-2">Save as Admin</button>
                        </div>

                        <style>
                            .action-btn-back:hover {
                                background-color: #FF5A1D !important;
                                border-color: #FF5A1D !important;
                                color: white !important;
                            }

                            .orange-checked:checked {
                                background-color: #FF5A1D !important;
                                border-color: #FF5A1D !important;
                            }

                            @media (max-width: 991.98px) {
                                .fixed-bottom {
                                    margin-left: 0 !important;
                                }
                            }
                        </style>
                    </form>
                </div> <!-- end col -->
            </div>
        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
</div>
@include('layouts.footer')
<script src="{{ asset('assets/js/custom-dropdown.js') }}"></script>