@include('layouts.header')
<div class="main-content">

    <div class="page-content pb-5">
        <div class="container-fluid mb-5">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="mb-sm-0 dashboard-title">Add Payee</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Add Payee</li>
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
                        <div class="card card-theme shadow-none rounded-3 border-0">
                            <div class="card-header border-0 bg-white p-4">
                                <h4 class="card-title mb-0 dashboard-title">Add Payee</h4>
                            </div>

                            <div class="card-body p-4 pt-0">
                                @if (Session::has('success'))
                                    <div class="alert alert-success mt-2 mb-4">{{ Session::get('success') }}</div>
                                @endif

                                <div class="live-preview">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Name</label>
                                                <input type="text" class="form-control" name="name"
                                                    value="{{ old('name') }}">
                                                @if ($errors->has('name'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('name') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">NIC</label>
                                                <input type="text" class="form-control" name="nic"
                                                    value="{{ old('nic') }}">
                                                @if ($errors->has('nic'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('nic') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Email</label>
                                                <input type="email" class="form-control" name="email"
                                                    value="{{ old('email') }}">
                                                @if ($errors->has('email'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('email') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Telephone</label>
                                                <input type="text" class="form-control" name="telephone"
                                                    value="{{ old('telephone') }}">
                                                @if ($errors->has('telephone'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('telephone') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Address</label>
                                                <input type="text" class="form-control" name="address"
                                                    value="{{ old('address') }}">
                                                @if ($errors->has('address'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('address') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Bank Name</label>
                                                <input type="text" class="form-control" name="bank_name"
                                                    value="{{ old('bank_name') }}">
                                                @if ($errors->has('bank_name'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('bank_name') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Branch</label>
                                                <input type="text" class="form-control" name="branch"
                                                    value="{{ old('branch') }}">
                                                @if ($errors->has('branch'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('branch') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Account No</label>
                                                <input type="text" class="form-control" name="account_no"
                                                    value="{{ old('account_no') }}">
                                                @if ($errors->has('account_no'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('account_no') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Company
                                                    Name</label>
                                                <input type="text" class="form-control" name="company_name"
                                                    value="{{ old('company_name') }}">
                                                @if ($errors->has('company_name'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('company_name') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Description</label>
                                                <textarea class="form-control"
                                                    name="discription">{{ old('discription') }}</textarea>
                                                @if ($errors->has('discription'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('discription') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                    </div>
                                    <!--end row-->
                                </div>
                            </div>
                        </div> <!-- end card -->

                        <div class="fixed-bottom bg-white border-top p-3 d-flex justify-content-between align-items-center"
                            style="z-index: 1001; margin-left: 250px;">
                            <button type="button" class="btn btn-outline-secondary px-4 py-2 action-btn-back"
                                style="color: #556476; border-color: #556476;"
                                onclick="window.location.href='{{ url('finance-payee') }}'">Back</button>
                            <button type="submit" class="btn btn-theme-orange px-5 py-2">Save Payee</button>
                        </div>

                        <style>
                            .action-btn-back:hover {
                                background-color: #FF5A1D !important;
                                border-color: #FF5A1D !important;
                                color: white !important;
                            }

                            @media (max-width: 991.98px) {
                                .fixed-bottom {
                                    margin-left: 0 !important;
                                }
                            }

                            /* Custom Orange Theme highlights */
                            .choices__inner:focus,
                            .choices__inner:active {
                                border-color: #FF5A1D !important;
                            }

                            .choices__list--dropdown .choices__item--selectable.is-highlighted {
                                background-color: #FF5A1D !important;
                                color: white !important;
                            }

                            .choices__list--multiple .choices__item {
                                background-color: #FF5A1D !important;
                                border: 1px solid #FF5A1D !important;
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