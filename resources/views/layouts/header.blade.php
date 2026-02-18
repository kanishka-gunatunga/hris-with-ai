<?php
use App\Models\OtherAdminDetails;
use App\Models\OtherHRManagerDetails;
use App\Models\OtherEmployeeDetails;
use App\Models\OtherHODDetails;
use App\Models\OtherAuthoriserDetails;
use App\Models\OtherClientDetails;
date_default_timezone_set('Asia/Colombo');
?>
<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
    data-sidebar-image="none" data-preloader="disable">

<head>
    <meta charset="utf-8" />
    <title>Enerprise HRM</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

    <!-- Existing CSS for functionality -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/plugins/monthSelect/style.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/plugins/monthSelect/index.js"></script>

    <!-- App Css (Original Theme) -->
    <!-- We purposefully keep this AFTER bootstrap to ensure theme overrides work, but BEFORE our custom CSS -->
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Custom Scoped Styles for New Sidebar/Header -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&family=Nunito+Sans:wght@400;600;700&display=swap');

        :root {
            --sidebar-width: 260px;
            --header-height: 70px;
            --primary-orange: #FF5A1D;
            --light-orange-bg: #fff1eb;
            /* approximate for #FF5A1D33 */
            --border-color: #E8E9EB;
            --text-color: #556476;
            --bg-body: #F6F6F8;
        }

        body {
            background-color: var(--bg-body);
            font-family: 'Nunito Sans', sans-serif;
            margin: 0;
            overflow-x: hidden;
            /* Prevent horizontal scroll */
        }

        /* --- WRAPPER --- */
        #layout-wrapper {
            display: flex;
            width: 100%;
            min-height: 100vh;
            padding-left: 0 !important;
            margin-left: 0 !important;
        }

        body {
            padding-left: 0 !important;
            margin-left: 0 !important;
        }

        /* --- SIDEBAR --- */
        .custom-sidebar {
            width: var(--sidebar-width);
            background-color: #F6F6F8;
            border-right: 2px solid var(--border-color);
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            z-index: 1002;
            overflow-y: auto;
            /* Enable SCROLLING for sidebar */
            padding-bottom: 20px;
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
        }

        .custom-sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .custom-sidebar::-webkit-scrollbar-thumb {
            background-color: #ccc;
            border-radius: 3px;
        }

        .sidebar-logo {
            height: var(--header-height);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 10px;
            flex-shrink: 0;
        }

        .sidebar-logo h2 {
            font-family: 'Nunito', sans-serif;
            font-weight: 800;
            color: var(--primary-orange);
            font-size: 26px;
            margin: 0;
        }

        .sidebar-menu {
            padding: 0 16px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        /* Navigation Links */
        .nav-link-custom {
            display: flex;
            align-items: center;
            justify-content: space-between;
            /* For arrow */
            padding: 12px 16px;
            font-family: 'Nunito', sans-serif;
            font-weight: 600;
            color: var(--text-color);
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.2s;
            cursor: pointer;
            border: none;
            background: transparent;
            width: 100%;
        }

        .nav-link-custom .nav-content {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .nav-link-custom i {
            font-size: 20px;
            color: var(--text-color);
        }

        .nav-link-custom:hover,
        .nav-link-custom[aria-expanded="true"] {
            background-color: var(--light-orange-bg);
            color: var(--primary-orange);
        }

        .nav-link-custom:hover i,
        .nav-link-custom[aria-expanded="true"] i {
            color: var(--primary-orange);
        }

        .nav-link-custom.active-nav {
            background-color: var(--primary-orange);
            color: white !important;
            border-radius: 8px 0 0 8px;
            /* Design aspect from user */
            margin-right: -16px;
            /* Pull to edge */
            padding-right: 32px;
            position: relative;
        }

        .nav-link-custom.active-nav::after {
            content: '';
            position: absolute;
            right: 0;
            top: 0;
            bottom: 0;
            width: 5px;
            background-color: #FFA600;
            /* Orange Accent */
        }

        .nav-link-custom.active-nav i {
            color: white !important;
        }

        /* Submenus */
        .submenu-container {
            padding-left: 0;
            list-style: none;
            overflow: hidden;
            transition: max-height 0.3s ease-in-out;
            max-height: 0;
            /* Default hidden */
        }

        .submenu-container.show {
            max-height: 500px;
            /* Arbitrary large height for transition */
        }

        .submenu-link {
            display: block;
            padding: 8px 16px 8px 58px;
            /* Indent */
            color: var(--text-color);
            font-size: 0.9em;
            text-decoration: none;
            transition: color 0.2s;
        }

        .submenu-link:hover {
            color: var(--primary-orange);
        }

        .submenu-link.active {
            color: var(--primary-orange);
            font-weight: 700;
        }

        /* --- CONTENT AREA & HEADER --- */
        #layout-wrapper>.main-content {
            margin-left: var(--sidebar-width);
            width: calc(100% - var(--sidebar-width));
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            left: 0;
            transform: none;
            position: relative;
            padding-left: 0;
            /* Fix for potential double gap */
        }

        /* Specific reset for nested main-content divs found in page files to prevent double-margin on desktop */
        #main-content-nested-reset,
        .main-content .main-content {
            margin-left: 0 !important;
            width: 100% !important;
            padding-left: 0 !important;
        }

        .custom-header {
            height: auto;
            min-height: var(--header-height);
            background: white;
            border-bottom: 2px solid var(--border-color);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 15px 30px;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        /* Search Bar */
        .header-search {
            position: relative;
            width: 350px;
        }

        .header-search input {
            width: 100%;
            background-color: rgba(255, 90, 29, 0.05);
            border: none;
            padding: 10px 15px 10px 45px;
            border-radius: 8px;
            font-family: 'Nunito Sans', sans-serif;
            color: var(--text-color);
            outline: none;
        }

        .header-search input:focus {
            box-shadow: 0 0 0 2px #ffccbc;
        }

        .header-search svg {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            width: 18px;
            height: 18px;
            stroke: var(--text-color);
        }

        /* Header Actions */
        .header-actions {
            display: flex;
            align-items: center;
            gap: 25px;
        }

        .notification-btn {
            background: none;
            border: none;
            position: relative;
            cursor: pointer;
        }

        .notification-icon {
            color: #556476;
            width: 24px;
            height: 24px;
        }

        .notification-btn:hover .notification-icon {
            color: var(--primary-orange);
        }

        .notification-badge {
            position: absolute;
            top: -2px;
            right: -2px;
            width: 10px;
            height: 10px;
            background-color: #FFA600;
            border: 2px solid white;
            border-radius: 50%;
        }

        /* Profile Dropdown */
        .profile-dropdown-container {
            position: relative;
        }

        .profile-btn {
            display: flex;
            align-items: center;
            gap: 10px;
            background-color: rgba(255, 90, 29, 0.1);
            padding: 6px 16px 6px 8px;
            border-radius: 30px;
            border: none;
            cursor: pointer;
            transition: background 0.2s;
        }

        .profile-btn:hover {
            background-color: rgba(255, 90, 29, 0.2);
        }

        .profile-img {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            object-fit: cover;
        }

        .profile-name {
            font-family: 'Nunito Sans', sans-serif;
            font-weight: 600;
            color: var(--text-color);
            font-size: 14px;
        }

        .profile-chevron {
            color: #b7481d;
            width: 16px;
            height: 16px;
        }

        .custom-dropdown-menu {
            position: absolute;
            right: 0;
            top: 100%;
            margin-top: 10px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            min-width: 180px;
            padding: 8px 0;
            display: none;
            z-index: 1050;
        }

        .custom-dropdown-menu.show {
            display: block;
        }

        .custom-dropdown-item {
            display: block;
            padding: 10px 20px;
            color: var(--text-color);
            text-decoration: none;
            font-family: 'Nunito Sans', sans-serif;
            font-size: 14px;
        }

        .custom-dropdown-item:hover {
            background-color: #f8f9fa;
            color: var(--primary-orange);
        }

        /* Mobile Toggle */
        .mobile-menu-btn {
            display: none;
            background: none;
            border: none;
            font-size: 24px;
            color: var(--text-color);
            margin-right: 15px;
        }

        @media (max-width: 991.98px) {
            .custom-sidebar {
                transform: translateX(-100%);
            }

            .custom-sidebar.open {
                transform: translateX(0);
            }

            #layout-wrapper>.main-content {
                margin-left: 0 !important;
                width: 100% !important;
            }

            .mobile-menu-btn {
                display: block;
            }

            .header-search {
                /* Hide search on small mobile if needed or just shrink */
                display: none;
            }
        }

        /* Main Content Layout Fix */
        .page-content {
            padding: calc(var(--header-height) + 1.5rem) 1.5rem 1.5rem 1.5rem;
            padding-top: 1.5rem;
        }

        .dashboard-title {
            font-size: 24px;
            color: #070707;
            font-weight: 500;
        }

        /* --- KONNECT THEME TABLE STYLES --- */
        .konnect-table-wrapper {
            border: 1px solid #E8E9EB;
            border-radius: 8px;
            overflow: hidden;
            background: white;
        }

        .konnect-table thead {
            background-color: rgba(255, 90, 29, 0.08);
            /* Light orange tint matching bg-[#FF5A1D33]/20 */
        }

        .konnect-table thead th {
            color: #556476;
            font-size: 13px;
            font-weight: 600;
            padding: 12px 16px;
            border-bottom: 1px solid #E8E9EB;
            white-space: nowrap;
        }

        .konnect-table tbody tr {
            transition: all 0.2s;
            border-bottom: 1px solid #f3f3f5;
        }

        .konnect-table tbody tr:hover {
            background-color: #fdf2f8;
            /* Matching hover:bg-pink-50 */
        }

        .konnect-table tbody td {
            padding: 12px 16px;
            color: #172635;
            font-size: 14px;
            vertical-align: middle;
        }

        /* Action Buttons */
        .btn-icon-soft-red {
            background-color: #FFE9E5;
            color: #ED2227;
            width: 32px;
            height: 32px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 6px;
            border: none;
            transition: all 0.2s;
        }

        .btn-icon-soft-red:hover {
            background-color: #ffccc7;
            color: #c41e22;
        }

        .btn-icon-soft-blue {
            background-color: #E7E9FD;
            color: #4A58EC;
            width: 32px;
            height: 32px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 6px;
            border: none;
            transition: all 0.2s;
        }

        .btn-icon-soft-blue:hover {
            background-color: #dbe0fc;
            color: #3b46bd;
        }

        .btn-icon-soft-yellow {
            background-color: #fff8e6;
            /* light yellow/orange */
            color: #FFA600;
            width: 32px;
            height: 32px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 6px;
            border: none;
            transition: all 0.2s;
        }

        .btn-icon-soft-yellow:hover {
            background-color: #ffeeb3;
        }

        .btn-icon-soft-green {
            background-color: #d1fae5;
            /* soft green */
            color: #10b981;
            /* green-500 */
            width: 32px;
            height: 32px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 6px;
            border: none;
            transition: all 0.2s;
        }

        .btn-icon-soft-green:hover {
            background-color: #a7f3d0;
            color: #059669;
        }

        /* DataTables Overrides for Konnect Look */
        div.dataTables_wrapper div.dataTables_filter input {
            border: 1px solid #E8E9EB;
            border-radius: 6px;
            padding: 6px 12px;
            font-family: 'Nunito Sans', sans-serif;
        }

        /* Center Pagination */
        div.dataTables_wrapper div.dataTables_paginate {
            display: flex;
            justify-content: center;
            margin-top: 1rem;
            width: 100%;
            text-align: center;
        }

        /* Hide "Showing x to y of z entries" */
        div.dataTables_wrapper div.dataTables_info {
            display: none;
        }

        /* Pagination Buttons */
        .dataTables_paginate .paginate_button {
            border-radius: 6px !important;
            border: none !important;
            padding: 4px 8px !important;
            margin: 0 2px !important;
            color: #556476 !important;
            background: transparent !important;
        }

        .dataTables_paginate .paginate_button:hover {
            background: #FFE9E5 !important;
            color: #FF5A1D !important;
        }

        .dataTables_paginate .paginate_button.current,
        .dataTables_paginate .paginate_button.current:hover,
        .dataTables_paginate .page-item.active .page-link {
            background-color: #FF5A1D !important;
            color: white !important;
            border-color: #FF5A1D !important;
            font-weight: 600;
            border-radius: 6px !important;
        }

        .dataTables_paginate .page-link {
            color: #556476;
            border: none !important;
            border-radius: 6px !important;
            margin: 0 1px;
            padding: 4px 8px !important;
        }

        .dataTables_paginate .page-link:hover {
            background-color: #FFE9E5 !important;
            color: #FF5A1D !important;
        }

        border-radius: 6px !important;
        }

        /* Checkbox Styling */
        .form-check-input-konnect {
            border: 1px solid #f472b6;
            /* pink-400 */
            border-radius: 4px;
            width: 18px;
            height: 18px;
        }

        .form-check-input-konnect:checked {
            background-color: #db2777;
            /* pink-600 */
            border-color: #db2777;
        }

        /* Dashboard Theme Utilities */
        body {
            font-family: 'Nunito Sans', sans-serif !important;
            background-color: var(--bg-body) !important;
        }

        .text-primary-orange {
            color: var(--primary-orange) !important;
        }

        .bg-primary-orange {
            background-color: var(--primary-orange) !important;
            color: white !important;
        }

        .bg-soft-orange {
            background-color: var(--light-orange-bg) !important;
        }

        .card-theme {
            background: #ffffff;
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
            margin-bottom: 24px;
            overflow: hidden;
        }

        .card-theme .card-header {
            background: transparent;
            border-bottom: 1px solid #f3f3f3;
            padding: 1.25rem 1.5rem;
        }

        .card-theme .card-header .card-title {
            font-size: 16px;
            font-weight: 700;
            color: var(--text-color);
            margin: 0;
        }

        .card-theme .card-body {
            padding: 1.5rem;
        }

        .widget-icon-wrapper {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: var(--light-orange-bg);
            color: var(--primary-orange);
        }

        .widget-icon-wrapper i {
            font-size: 24px;
        }

        .dashboard-title {
            color: #172635;
            font-weight: 800;
            font-size: 24px;
        }

        .table-theme thead th {
            background-color: #F9FAFB;
            color: #6B7280;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.05em;
            border-bottom: 1px solid #E5E7EB;
        }

        .table-theme tbody td {
            color: var(--text-color);
            border-bottom: 1px solid #f3f3f3;
            padding: 1rem 0.75rem;
        }

        .btn-theme-orange {
            background-color: var(--primary-orange);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-theme-orange:hover {
            background-color: #e04f1a;
            color: white;
        }
        
        .btn-info {
            background-color: var(--primary-orange);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-info:hover {
            background-color: #e04f1a;
            color: white;
        }
        .dashboard-card-title{
            min-height: 35px;
        }
        .flatpickr-monthSelect-month.today {
            border-color: #e04f1a;
            background:#e04f1a;
            color:#fff;
        }
        .flatpickr-monthSelect-month.selected, .flatpickr-monthSelect-month.startRange, .flatpickr-monthSelect-month.endRange {
            background-color: #ff5a1d;
            color: #fff;
            border-color: #ff5a1d;
        }
    </style>
</head>

<body>

    <div id="layout-wrapper">

        <!-- Sidebar -->
        <aside class="custom-sidebar" id="sidebar">
            <div class="sidebar-logo">
                <a href="{{ url('dashboard') }}" style="text-decoration: none;">
                    <!--<h2>HRIS</h2>-->
                    <img src="{{ asset('assets/images/slt_logo_new.png') }}" style="width:150px;">
                </a>
            </div>

            <nav class="sidebar-menu">

                <!-- Dashboard -->
                @auth
                    <a href="{{ url('dashboard') }}"
                        class="nav-link-custom {{ request()->is('dashboard') ? 'active-nav' : '' }}">
                        <div class="nav-content">
                            <i class="mdi mdi-monitor-dashboard"></i>
                            <span>Dashboard</span>
                        </div>
                    </a>

                    <!-- Leaves -->
                    @if(Auth::user()->user_role != 1 || Auth::user()->user_role != 3)
                        <div>
                            <button class="nav-link-custom" onclick="toggleSubmenu('leaves-menu')"
                                aria-expanded="{{ request()->is('employee-leaves/*') || request()->is('manage-leaves') ? 'true' : 'false' }}">
                                <div class="nav-content">
                                    <i class="mdi mdi-logout"></i>
                                    <span>Leaves</span>
                                </div>
                                <i class="mdi mdi-chevron-down"></i>
                            </button>
                            <div id="leaves-menu"
                                class="submenu-container {{ request()->is('employee-leaves/*') || request()->is('manage-leaves') ? 'show' : '' }}">
                                @if (Auth::user()->user_role != 1)
                                    <a href="{{ url('employee-leaves/' . Auth::user()->id) }}"
                                        class="submenu-link {{ request()->is('employee-leaves/' . Auth::user()->id) ? 'active' : '' }}">My
                                        Leaves</a>
                                @endif
                                @if (Auth::user()->user_role != 3)
                                    <a href="{{ url('manage-leaves') }}"
                                        class="submenu-link {{ request()->is('manage-leaves') ? 'active' : '' }}">Manage Leaves</a>
                                @endif
                            </div>
                        </div>
                    @endif

                    <!-- Users (Admin Only) -->
                    @if (Auth::user()->user_role == 1)
                        <div>
                            <button class="nav-link-custom" onclick="toggleSubmenu('users-menu')"
                                aria-expanded="{{ request()->is('admins') || request()->is('hr-managers') || request()->is('hod') || request()->is('authorisers') || request()->is('blocked-users') || request()->is('blocked-ips') ? 'true' : 'false' }}">
                                <div class="nav-content">
                                    <i class="mdi mdi-account-group"></i>
                                    <span>Users</span>
                                </div>
                                <i class="mdi mdi-chevron-down"></i>
                            </button>
                            <div id="users-menu"
                                class="submenu-container {{ request()->is('admins') || request()->is('hr-managers') || request()->is('hod') || request()->is('authorisers') || request()->is('blocked-users') || request()->is('blocked-ips') ? 'show' : '' }}">
                                <a href="{{ url('admins') }}"
                                    class="submenu-link {{ request()->is('admins') ? 'active' : '' }}">Admins</a>
                                <a href="{{ url('hr-managers') }}"
                                    class="submenu-link {{ request()->is('hr-managers') ? 'active' : '' }}">HR Managers</a>
                                <a href="{{ url('hod') }}"
                                    class="submenu-link {{ request()->is('hod') ? 'active' : '' }}">HOD</a>
                                <a href="{{ url('authorisers') }}"
                                    class="submenu-link {{ request()->is('authorisers') ? 'active' : '' }}">Authorizers</a>
                                <a href="{{ url('blocked-users') }}"
                                    class="submenu-link {{ request()->is('blocked-users') ? 'active' : '' }}">Blocked Users</a>
                                <a href="{{ url('blocked-ips') }}"
                                    class="submenu-link {{ request()->is('blocked-ips') ? 'active' : '' }}">Blocked IP's</a>
                            </div>
                        </div>
                    @endif

                    <!-- Employees -->
                    @if (Auth::user()->user_role == 1 || Auth::user()->user_role == 2 || Auth::user()->user_role == 5)
                        <div>
                            <button class="nav-link-custom" onclick="toggleSubmenu('employees-menu')"
                                aria-expanded="{{ request()->is('employees') || request()->is('add-employee') ? 'true' : 'false' }}">
                                <div class="nav-content">
                                    <i class="mdi mdi-account-cowboy-hat"></i>
                                    <span>Employees</span>
                                </div>
                                <i class="mdi mdi-chevron-down"></i>
                            </button>
                            <div id="employees-menu"
                                class="submenu-container {{ request()->is('employees') || request()->is('add-employee') ? 'show' : '' }}">
                                <a href="{{ url('employees') }}"
                                    class="submenu-link {{ request()->is('employees') ? 'active' : '' }}">All Employees</a>
                                <a href="{{ url('add-employee') }}"
                                    class="submenu-link {{ request()->is('add-employee') ? 'active' : '' }}">Add Employee</a>
                            </div>
                        </div>
                    @endif

                    <!-- Core HR -->
                    @if (Auth::user()->user_role == 1 || Auth::user()->user_role == 2)
                        <div>
                            <button class="nav-link-custom" onclick="toggleSubmenu('core-hr-menu')"
                                aria-expanded="{{ request()->is('core-hr-*') || request()->is('employment-type-history') ? 'true' : 'false' }}">
                                <div class="nav-content">
                                    <i class="mdi mdi-cellphone-dock"></i>
                                    <span>Core HR</span>
                                </div>
                                <i class="mdi mdi-chevron-down"></i>
                            </button>
                            <div id="core-hr-menu"
                                class="submenu-container {{ request()->is('core-hr-*') || request()->is('employment-type-history') ? 'show' : '' }}">
                                <a href="{{ url('core-hr-promotions') }}"
                                    class="submenu-link {{ request()->is('core-hr-promotions') ? 'active' : '' }}">Promotions</a>
                                <a href="{{ url('core-hr-awards') }}"
                                    class="submenu-link {{ request()->is('core-hr-awards') ? 'active' : '' }}">Awards</a>
                                <a href="{{ url('core-hr-travels') }}"
                                    class="submenu-link {{ request()->is('core-hr-travels') ? 'active' : '' }}">Travels</a>
                                <a href="{{ url('core-hr-transfers') }}"
                                    class="submenu-link {{ request()->is('core-hr-transfers') ? 'active' : '' }}">Transfers</a>
                                <a href="{{ url('core-hr-resignations') }}"
                                    class="submenu-link {{ request()->is('core-hr-resignations') ? 'active' : '' }}">Resignations</a>
                                <a href="{{ url('core-hr-complaints') }}"
                                    class="submenu-link {{ request()->is('core-hr-complaints') ? 'active' : '' }}">Complaints</a>
                                <a href="{{ url('core-hr-warnings') }}"
                                    class="submenu-link {{ request()->is('core-hr-warnings') ? 'active' : '' }}">Warnings</a>
                                <a href="{{ url('core-hr-terminations') }}"
                                    class="submenu-link {{ request()->is('core-hr-terminations') ? 'active' : '' }}">Terminations</a>
                                <a href="{{ url('employment-type-history') }}"
                                    class="submenu-link {{ request()->is('employment-type-history') ? 'active' : '' }}">Employment
                                    Type History</a>
                            </div>
                        </div>
                    @endif

                    <!-- Project Management -->
                    @if (Auth::user()->user_role == 1 || Auth::user()->user_role == 2 || Auth::user()->user_role == 5)
                        <div>
                            <button class="nav-link-custom" onclick="toggleSubmenu('pm-menu')"
                                aria-expanded="{{ request()->is('pm-*') ? 'true' : 'false' }}">
                                <div class="nav-content">
                                    <i class="mdi mdi-briefcase"></i>
                                    <span>Project Management</span>
                                </div>
                                <i class="mdi mdi-chevron-down"></i>
                            </button>
                            <div id="pm-menu" class="submenu-container {{ request()->is('pm-*') ? 'show' : '' }}">
                                <a href="{{ url('pm-clients') }}"
                                    class="submenu-link {{ request()->is('pm-clients') ? 'active' : '' }}">Clients</a>
                                <a href="{{ url('pm-projects') }}"
                                    class="submenu-link {{ request()->is('pm-projects') ? 'active' : '' }}">Projects</a>
                                <a href="{{ url('pm-tasks') }}"
                                    class="submenu-link {{ request()->is('pm-tasks') ? 'active' : '' }}">Tasks</a>
                            </div>
                        </div>
                    @endif

                    <!-- Organization -->
                    @if (Auth::user()->user_role == 1 || Auth::user()->user_role == 2)
                        <div>
                            <button class="nav-link-custom" onclick="toggleSubmenu('org-menu')"
                                aria-expanded="{{ request()->is('organization-*') ? 'true' : 'false' }}">
                                <div class="nav-content">
                                    <i class="mdi mdi-source-branch"></i>
                                    <span>Organization</span>
                                </div>
                                <i class="mdi mdi-chevron-down"></i>
                            </button>
                            <div id="org-menu" class="submenu-container {{ request()->is('organization-*') ? 'show' : '' }}">
                                <a href="{{ url('organization-departments') }}"
                                    class="submenu-link {{ request()->is('organization-departments') ? 'active' : '' }}">Departments</a>
                                <a href="{{ url('organization-locations') }}"
                                    class="submenu-link {{ request()->is('organization-locations') ? 'active' : '' }}">Locations</a>
                                <a href="{{ url('organization-designations') }}"
                                    class="submenu-link {{ request()->is('organization-designations') ? 'active' : '' }}">Designations</a>
                                <a href="{{ url('organization-announcements') }}"
                                    class="submenu-link {{ request()->is('organization-announcements') ? 'active' : '' }}">Announcements</a>
                                <a href="{{ url('organization-company-policy') }}"
                                    class="submenu-link {{ request()->is('organization-company-policy') ? 'active' : '' }}">Company
                                    Policy</a>
                            </div>
                        </div>
                    @endif

                    <!-- Event & Meeting -->
                    @if (Auth::user()->user_role == 1 || Auth::user()->user_role == 2 || Auth::user()->user_role == 5)
                        <div>
                            <button class="nav-link-custom" onclick="toggleSubmenu('event-meeting-menu')"
                                aria-expanded="{{ request()->is('events') || request()->is('meetings') ? 'true' : 'false' }}">
                                <div class="nav-content">
                                    <i class="mdi mdi-calendar-clock"></i>
                                    <span>Event & Meeting</span>
                                </div>
                                <i class="mdi mdi-chevron-down"></i>
                            </button>
                            <div id="event-meeting-menu"
                                class="submenu-container {{ request()->is('events') || request()->is('meetings') ? 'show' : '' }}">
                                <a href="{{ url('events') }}"
                                    class="submenu-link {{ request()->is('events') ? 'active' : '' }}">Events</a>
                                <a href="{{ url('meetings') }}"
                                    class="submenu-link {{ request()->is('meetings') ? 'active' : '' }}">Meetings</a>
                            </div>
                        </div>
                    @endif

                    <!-- Performance -->
                    @if (Auth::user()->user_role == 1 || Auth::user()->user_role == 2 || Auth::user()->user_role == 5)
                        <div>
                            <button class="nav-link-custom" onclick="toggleSubmenu('performance-menu')"
                                aria-expanded="{{ request()->is('performance-*') ? 'true' : 'false' }}">
                                <div class="nav-content">
                                    <i class="mdi mdi-trending-up"></i>
                                    <span>Performance</span>
                                </div>
                                <i class="mdi mdi-chevron-down"></i>
                            </button>
                            <div id="performance-menu"
                                class="submenu-container {{ request()->is('performance-*') ? 'show' : '' }}">
                                <a href="{{ url('performance-goal-type') }}"
                                    class="submenu-link {{ request()->is('performance-goal-type') ? 'active' : '' }}">Goal
                                    Type</a>
                                <a href="{{ url('performance-goal-tracking') }}"
                                    class="submenu-link {{ request()->is('performance-goal-tracking') ? 'active' : '' }}">Goal
                                    Tracking</a>
                            </div>
                        </div>
                    @endif

                    <!-- Recruitment -->
                    @if (Auth::user()->user_role == 1 || Auth::user()->user_role == 2 || Auth::user()->user_role == 5)
                        <div>
                            <button class="nav-link-custom" onclick="toggleSubmenu('recruitment-menu')"
                                aria-expanded="{{ request()->is('job-post') || request()->is('add-recruitment') || request()->is('search-cvs') ? 'true' : 'false' }}">
                                <div class="nav-content">
                                    <i class="mdi mdi-account-multiple-plus"></i>
                                    <span>Recruitment</span>
                                </div>
                                <i class="mdi mdi-chevron-down"></i>
                            </button>
                            <div id="recruitment-menu"
                                class="submenu-container {{ request()->is('job-post') || request()->is('add-recruitment') || request()->is('search-cvs') ? 'show' : '' }}">
                                <a href="{{ url('job-post') }}"
                                    class="submenu-link {{ request()->is('job-post') ? 'active' : '' }}">Job Post</a>
                                <a href="{{ url('add-recruitment') }}"
                                    class="submenu-link {{ request()->is('add-recruitment') ? 'active' : '' }}">Add
                                    Recruitment</a>
                                <a href="{{ url('search-cvs') }}"
                                    class="submenu-link {{ request()->is('search-cvs') ? 'active' : '' }}">Search CV's</a>
                            </div>
                        </div>
                    @endif

                    <!-- Attendance -->
                    <div>
                        <button class="nav-link-custom" onclick="toggleSubmenu('attendance-menu')"
                            aria-expanded="{{ request()->is('my-attendence-history') || request()->is('approve-user-checkout-time') ? 'true' : 'false' }}">
                            <div class="nav-content">
                                <i class="mdi mdi-account-multiple-check"></i>
                                <span>Attendance</span>
                            </div>
                            <i class="mdi mdi-chevron-down"></i>
                        </button>
                        <div id="attendance-menu"
                            class="submenu-container {{ request()->is('my-attendence-history') || request()->is('approve-user-checkout-time') ? 'show' : '' }}">
                            <a href="{{ url('my-attendence-history') }}"
                                class="submenu-link {{ request()->is('my-attendence-history') ? 'active' : '' }}">My
                                Attendance</a>
                            @if (Auth::user()->user_role == 1 || Auth::user()->user_role == 2 || Auth::user()->user_role == 5 || Auth::user()->user_role == 6)
                                <a href="{{ url('approve-user-checkout-time') }}"
                                    class="submenu-link {{ request()->is('approve-user-checkout-time') ? 'active' : '' }}">Approve
                                    Checkout</a>
                            @endif
                        </div>
                    </div>

                    <!-- Reports -->
                    @if (Auth::user()->user_role == 1 || Auth::user()->user_role == 2 || Auth::user()->user_role == 5)
                        <div>
                            <button class="nav-link-custom" onclick="toggleSubmenu('reports-menu')"
                                aria-expanded="{{ request()->is('leave-report') || request()->is('sallary-report') || request()->is('attendance-report') ? 'true' : 'false' }}">
                                <div class="nav-content">
                                    <i class="mdi mdi-file-account"></i>
                                    <span>Reports</span>
                                </div>
                                <i class="mdi mdi-chevron-down"></i>
                            </button>
                            <div id="reports-menu"
                                class="submenu-container {{ request()->is('leave-report') || request()->is('sallary-report') || request()->is('attendance-report') ? 'show' : '' }}">
                                <a href="{{ url('leave-report') }}"
                                    class="submenu-link {{ request()->is('leave-report') ? 'active' : '' }}">Leave Report</a>
                                <a href="{{ url('sallary-report') }}"
                                    class="submenu-link {{ request()->is('sallary-report') ? 'active' : '' }}">Salary Report</a>
                                <a href="{{ url('attendance-report') }}"
                                    class="submenu-link {{ request()->is('attendance-report') ? 'active' : '' }}">Attendance
                                    Report</a>
                            </div>
                        </div>
                    @endif

                    <!-- Training -->
                    @if (Auth::user()->user_role == 1 || Auth::user()->user_role == 2)
                        <div>
                            <button class="nav-link-custom" onclick="toggleSubmenu('training-menu')"
                                aria-expanded="{{ request()->is('training-*') ? 'true' : 'false' }}">
                                <div class="nav-content">
                                    <i class="mdi mdi-account-sync"></i>
                                    <span>Training</span>
                                </div>
                                <i class="mdi mdi-chevron-down"></i>
                            </button>
                            <div id="training-menu" class="submenu-container {{ request()->is('training-*') ? 'show' : '' }}">
                                <a href="{{ url('training-trainers') }}"
                                    class="submenu-link {{ request()->is('training-trainers') ? 'active' : '' }}">Trainers</a>
                                <a href="{{ url('training-type') }}"
                                    class="submenu-link {{ request()->is('training-type') ? 'active' : '' }}">Training Type</a>
                                <a href="{{ url('training-list') }}"
                                    class="submenu-link {{ request()->is('training-list') ? 'active' : '' }}">Training List</a>
                                <a href="{{ url('training-courses') }}"
                                    class="submenu-link {{ request()->is('training-courses') ? 'active' : '' }}">Training
                                    Courses</a>
                            </div>
                        </div>
                    @endif

                    <!-- Department Directory -->
                    <a href="{{ url('department-directory') }}"
                        class="nav-link-custom {{ request()->is('department-directory') ? 'active-nav' : '' }}">
                        <div class="nav-content">
                            <i class="mdi mdi-subdirectory-arrow-right"></i>
                            <span>Dept. Directory</span>
                        </div>
                    </a>

                    <!-- Finance -->
                    @if (Auth::user()->user_role == 1)
                        <div>
                            <button class="nav-link-custom" onclick="toggleSubmenu('finance-menu')"
                                aria-expanded="{{ request()->is('finance-*') ? 'true' : 'false' }}">
                                <div class="nav-content">
                                    <i class="mdi mdi-cash-multiple"></i>
                                    <span>Finance</span>
                                </div>
                                <i class="mdi mdi-chevron-down"></i>
                            </button>
                            <div id="finance-menu" class="submenu-container {{ request()->is('finance-*') ? 'show' : '' }}">
                                <a href="{{ url('finance-account-list') }}"
                                    class="submenu-link {{ request()->is('finance-account-list') ? 'active' : '' }}">Accounts
                                    List</a>
                                <a href="{{ url('finance-account-balances') }}"
                                    class="submenu-link {{ request()->is('finance-account-balances') ? 'active' : '' }}">Balances</a>
                                <a href="{{ url('finance-payer') }}"
                                    class="submenu-link {{ request()->is('finance-payer') ? 'active' : '' }}">Payer</a>
                                <a href="{{ url('finance-payee') }}"
                                    class="submenu-link {{ request()->is('finance-payee') ? 'active' : '' }}">Payee</a>
                                <a href="{{ url('finance-deposit') }}"
                                    class="submenu-link {{ request()->is('finance-deposit') ? 'active' : '' }}">Deposit</a>
                                <a href="{{ url('finance-expense') }}"
                                    class="submenu-link {{ request()->is('finance-expense') ? 'active' : '' }}">Expense</a>
                                <a href="{{ url('finance-transfer') }}"
                                    class="submenu-link {{ request()->is('finance-transfer') ? 'active' : '' }}">Transfer</a>
                                <a href="{{ url('finance-transaction-history') }}"
                                    class="submenu-link {{ request()->is('finance-transaction-history') ? 'active' : '' }}">History</a>
                                <a href="{{ url('finance-payment') }}"
                                    class="submenu-link {{ request()->is('finance-payment') ? 'active' : '' }}">Payment</a>
                            </div>
                        </div>
                    @endif

                    <!-- Assets -->
                    @if (Auth::user()->user_role == 1)
                        <div>
                            <button class="nav-link-custom" onclick="toggleSubmenu('assets-menu')"
                                aria-expanded="{{ request()->is('assets') || request()->is('assets-category') ? 'true' : 'false' }}">
                                <div class="nav-content">
                                    <i class="mdi mdi-car"></i>
                                    <span>Assets</span>
                                </div>
                                <i class="mdi mdi-chevron-down"></i>
                            </button>
                            <div id="assets-menu"
                                class="submenu-container {{ request()->is('assets') || request()->is('assets-category') ? 'show' : '' }}">
                                <a href="{{ url('assets-category') }}"
                                    class="submenu-link {{ request()->is('assets-category') ? 'active' : '' }}">Category</a>
                                <a href="{{ url('assets-page') }}"
                                    class="submenu-link {{ request()->is('assets') ? 'active' : '' }}">Assets</a>
                            </div>
                        </div>
                    @endif

                    <!-- File Manager -->
                    @if (Auth::user()->user_role == 1 || Auth::user()->user_role == 2 || Auth::user()->user_role == 5 || Auth::user()->user_role == 6)
                        <div>
                            <button class="nav-link-custom" onclick="toggleSubmenu('file-manager-menu')"
                                aria-expanded="{{ request()->is('file-manager') || request()->is('file-oficial-documents') ? 'true' : 'false' }}">
                                <div class="nav-content">
                                    <i class="mdi mdi-folder-multiple"></i>
                                    <span>File Manager</span>
                                </div>
                                <i class="mdi mdi-chevron-down"></i>
                            </button>
                            <div id="file-manager-menu"
                                class="submenu-container {{ request()->is('file-manager') || request()->is('file-oficial-documents') ? 'show' : '' }}">
                                <a href="{{ url('file-manager') }}"
                                    class="submenu-link {{ request()->is('file-manager') ? 'active' : '' }}">File Manager</a>
                                <a href="{{ url('file-oficial-documents') }}"
                                    class="submenu-link {{ request()->is('file-oficial-documents') ? 'active' : '' }}">Official
                                    Documents</a>
                            </div>
                        </div>
                    @endif

                    <!-- Timesheets -->
                    @if (Auth::user()->user_role == 1 || Auth::user()->user_role == 2 || Auth::user()->user_role == 5 || Auth::user()->user_role == 4)
                        <div>
                            <button class="nav-link-custom" onclick="toggleSubmenu('timesheets-menu')"
                                aria-expanded="{{ request()->is('office-shift') || request()->is('manage-holiday') || request()->is('manage-leaves') || request()->is('update-attendances') || request()->is('leave-types') ? 'true' : 'false' }}">
                                <div class="nav-content">
                                    <i class="mdi mdi-calendar-clock"></i>
                                    <span>Timesheets</span>
                                </div>
                                <i class="mdi mdi-chevron-down"></i>
                            </button>
                            <div id="timesheets-menu"
                                class="submenu-container {{ request()->is('office-shift') || request()->is('manage-holiday') || request()->is('manage-leaves') || request()->is('update-attendances') || request()->is('leave-types') ? 'show' : '' }}">
                                <a href="{{ url('office-shift') }}"
                                    class="submenu-link {{ request()->is('office-shift') ? 'active' : '' }}">Office Shift</a>
                                <a href="{{ url('manage-holiday') }}"
                                    class="submenu-link {{ request()->is('manage-holiday') ? 'active' : '' }}">Manage
                                    Holiday</a>
                                <a href="{{ url('manage-leaves') }}"
                                    class="submenu-link {{ request()->is('manage-leaves') ? 'active' : '' }}">Manage Leaves</a>
                                <a href="{{ url('update-attendances') }}"
                                    class="submenu-link {{ request()->is('update-attendances') ? 'active' : '' }}">Update
                                    Attendances</a>
                                <a href="{{ url('leave-types') }}"
                                    class="submenu-link {{ request()->is('leave-types') ? 'active' : '' }}">Leave
                                    Types</a>
                            </div>
                        </div>
                    @endif

                    <!-- Form C -->
                    @if (Auth::user()->user_role == 1 || Auth::user()->user_role == 2 || Auth::user()->user_role == 5)
                        <a href="{{ url('form-c') }}" class="nav-link-custom {{ request()->is('form-c') ? 'active-nav' : '' }}">
                            <div class="nav-content">
                                <i class="mdi mdi-file-document-edit-outline"></i>
                                <span>Form C</span>
                            </div>
                        </a>
                    @endif

                    <!-- Accessories -->
                    @if (Auth::user()->user_role == 1)
                        <a href="{{ url('accessories') }}"
                            class="nav-link-custom {{ request()->is('accessories') ? 'active-nav' : '' }}">
                            <div class="nav-content">
                                <i class="mdi mdi-laptop"></i>
                                <span>Accessories</span>
                            </div>
                        </a>
                    @endif

                @endauth

            </nav>
        </aside>

        <!-- Main Content -->
        <div class="main-content">

            <!-- Header (Topbar) -->
            <header class="custom-header">
                <!-- Mobile Toggle -->
                <button class="mobile-menu-btn" onclick="toggleSidebar()">
                    <i class="mdi mdi-menu"></i>
                </button>

                <div class="header-search">
                    <svg viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M10.2779 10.2078L11.9728 11.9027M11.4374 7.22504C11.4374 8.31969 11.0025 9.3695 10.2285 10.1435C9.45447 10.9176 8.40465 11.3524 7.31 11.3524C6.21535 11.3524 5.16553 10.9176 4.3915 10.1435C3.61747 9.3695 3.18262 8.31969 3.18262 7.22504C3.18262 6.13039 3.61747 5.08057 4.3915 4.30654C5.16553 3.5325 6.21535 3.09766 7.31 3.09766C8.40465 3.09766 9.45447 3.5325 10.2285 4.30654C11.0025 5.08057 11.4374 6.13039 11.4374 7.22504Z"
                            stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <input type="text" placeholder="Search">
                </div>

                <div class="header-actions">
                    <!-- Notification Bell -->
                    <!-- <button class="notification-btn" aria-label="Notifications">
                        <svg class="notification-icon" width="22" height="22" viewBox="0 0 22 22" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M5.65921 17.1039V9.17929C5.65921 7.77814 6.21582 6.43437 7.20658 5.44361C8.19734 4.45285 9.54111 3.89624 10.9423 3.89624C12.3434 3.89624 13.6872 4.45285 14.6779 5.44361C15.6687 6.43437 16.2253 7.77814 16.2253 9.17929V17.1039M5.65921 17.1039H16.2253M5.65921 17.1039H3.89819M16.2253 17.1039H17.9863M10.0618 19.7454H11.8228"
                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path
                                d="M10.9423 3.89621C11.4286 3.89621 11.8228 3.50199 11.8228 3.0157C11.8228 2.52941 11.4286 2.13519 10.9423 2.13519C10.456 2.13519 10.0618 2.52941 10.0618 3.0157C10.0618 3.50199 10.456 3.89621 10.9423 3.89621Z"
                                stroke="currentColor" stroke-width="1.5" />
                        </svg>
                        <span class="notification-badge"></span>
                    </button> -->

                    <!-- User Profile -->
                    @auth
                                        <?php
                        $user = Auth::user();
                        $name = "User";
                        $role = "Member";
                        $image = "default.png";
                        $profileRoute = '#';

                        if ($user->user_role == 1) {
                            $image = OtherAdminDetails::where('user_id', $user->id)->value('image');
                            $fname = OtherAdminDetails::where('user_id', $user->id)->value('first_name');
                            $lname = OtherAdminDetails::where('user_id', $user->id)->value('last_name');
                            $name = $fname . ' ' . $lname;
                            $role = "Admin";
                            $profileRoute = url('edit-admin/' . $user->id);
                        } elseif ($user->user_role == 2) {
                            $image = OtherHRManagerDetails::where('user_id', $user->id)->value('image');
                            $fname = OtherHRManagerDetails::where('user_id', $user->id)->value('first_name');
                            $lname = OtherHRManagerDetails::where('user_id', $user->id)->value('last_name');
                            $name = $fname . ' ' . $lname;
                            $role = "HR Manager";
                            $profileRoute = url('edit-hr-manager/' . $user->id);
                        } elseif ($user->user_role == 3) {
                            $image = OtherEmployeeDetails::where('user_id', $user->id)->value('image');
                            $fname = OtherEmployeeDetails::where('user_id', $user->id)->value('first_name');
                            $lname = OtherEmployeeDetails::where('user_id', $user->id)->value('last_name');
                            $name = $fname . ' ' . $lname;
                            $role = "Employee";
                            $profileRoute = url('edit-employee/' . $user->id);
                        } elseif ($user->user_role == 5) {
                            $image = OtherHODDetails::where('user_id', $user->id)->value('image');
                            $name = OtherHODDetails::where('user_id', $user->id)->value('name');
                            $role = "HOD";
                            $profileRoute = url('edit-hod/' . $user->id);
                        } elseif ($user->user_role == 6) {
                            $image = OtherAuthoriserDetails::where('user_id', $user->id)->value('image');
                            $name = OtherAuthoriserDetails::where('user_id', $user->id)->value('name');
                            $role = "Authoriser";
                            $profileRoute = url('edit-authoriser/' . $user->id);
                        }
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                ?>
                                        <div class="profile-dropdown-container">
                                            <button class="profile-btn" onclick="toggleProfileMenu()">
                                                <img src="{{ asset('user_images/' . $image) }}"
                                                    onerror="this.src='{{ asset('assets/images/users/user-dummy-img.jpg') }}';"
                                                    alt="Profile" class="profile-img">
                                                <span class="profile-name">{{ $name }}</span>
                                                <svg class="profile-chevron" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down">
                                                    <polyline points="6 9 12 15 18 9"></polyline>
                                                </svg>
                                            </button>
                                            <div id="profile-menu" class="custom-dropdown-menu">
                                                <a href="{{ $profileRoute }}" class="custom-dropdown-item">Profile</a>
                                                <a href="{{ url('logout') }}" class="custom-dropdown-item">Logout</a>
                                            </div>
                                        </div>
                    @endauth
                </div>
            </header>

            <script>
                function toggleSubmenu(id) {
                    const el = document.getElementById(id);
                    el.classList.toggle('show');
                }

                function toggleProfileMenu() {
                    const el = document.getElementById('profile-menu');
                    el.classList.toggle('show');
                }

                function toggleSidebar() {
                    const el = document.getElementById('sidebar');
                    el.classList.toggle('open');
                }

                // Close dropdowns when clicking outside
                document.addEventListener('click', function (e) {
                    // Profile
                    const profileBtn = document.querySelector('.profile-btn');
                    const profileMenu = document.getElementById('profile-menu');
                    if (profileBtn && profileMenu && !profileBtn.contains(e.target) && !profileMenu.contains(e.target)) {
                        profileMenu.classList.remove('show');
                    }
                });
            </script>

            <!-- Page Content Starts Here (wrapper for content injected by other files) -->
            <!-- We do not close .main-content here, it wraps the content until footer -->