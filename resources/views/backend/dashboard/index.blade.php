@extends('backend.layouts.main')
@section('title')
    Dashboard
@endsection
@section('styles')
    <style>
        .card-text {
            font-size: 1.2rem;
            color: #666;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 15px;
        }

        .card-text strong {
            color: #5050509e;
            font-size: 1.5rem;
        }

        .card-icon {
            font-size: 2rem;
            color: #08c;
            margin-bottom: 15px;
        }


        .badge {
            font-size: 0.8rem;
            padding: 0.5rem 0.8rem;
            border-radius: 0.5rem;
            font-weight: bold;
        }

        .badge-success {
            background-color: #28a745;
        }

        .badge-warning {
            background-color: #c2940a;
        }

        .badge-danger {
            background-color: #dc3545;
        }

        .text-gradient {
            font-weight: 700;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(45deg, #7f7b7a, #3e349a);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 20px;
        }

        .user_pojects_boq_wrapper {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 15px;
        }

        .total_user_card {
            background-color: white;
            box-shadow: 0 0 16px rgba(0, 0, 0, 0.2);
            padding: 35px 25px;
            border-radius: 4px;
        }

        .user_icon_flx {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;

        }

        .first_txt {
            position: relative;
        }

        .first_txt ::before {
            position: absolute;
            content: " ";
            height: 80%;
            width: 2px;
            border-radius: 4px;
            background-color: #007bff;
            left: -10px;

        }

        .first_txt p {
            font-size: 18px;
            font-weight: 500;
            color: rgba(0, 0, 0, 1);
            margin: 0;
        }

        .bi {
            color: rgba(2, 131, 199, 1);
            height: 25px;
            width: 25px;
        }

        .total_number_flx {
            display: flex;
            align-items: center;
            justify-content: space-between;

        }

        .first_number p {
            font-size: 20px;
            font-weight: 600;
            margin: 0;

        }

        .dash_list {
            display: flex;
            align-items: center;
            gap: 25px;
            margin: 0;
            padding: 0;

        }

        .dash_list li {
            font-size: 13px;
            font-weight: 500;
            color: rgba(138, 138, 138, 1);

        }

        .group {
            display: flex;
            justify-content: space-between;
            width: 9%;
            height: 100%;
            align-items: self-end;
        }


        .project_txt_wrap {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 50px 30px;
        }

        .project_txt_wrap p {
            font-size: 18px;
            font-weight: 500;
            margin: 0;
            position: relative;

            &::before {
                position: absolute;
                content: " ";
                height: 80%;
                width: 2px;
                border-radius: 4px;
                background-color: #007bff;
                margin-left: -10px;
            }
        }
    </style>
@endsection
@section('main-content')
    <!-- Page Header -->
    <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
        <div>
            <h4 class="mb-0">Welcome To Dashboard {{ Auth::user()->name }}</h4>
        </div>
    </div>
    <!-- End Page Header -->



    <div class="user_pojects_boq_wrapper">
        <div class="total_user_card">
            <div class="user_icon_flx">
                <div class="first_txt">
                    <p>Inquiry</p>
                </div>
                <div class="user_icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-people-fill" viewBox="0 0 16 16">
                        <path
                            d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.24 2.24 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5" />
                    </svg>
                </div>
            </div>
            <div class="total_number_flx">
                <div class="first_number">
                    <p>{{ $enquiryNumber ?? '0' }}</p>
                </div>
                {{-- <ul class="dash_list">
                    <li>Male: 2 </li>
                    <li>Female: 2</li>
                </ul> --}}
            </div>

        </div>
        <div class="total_user_card">
            <div class="user_icon_flx">
                <div class="first_txt">
                    <p>Contact</p>
                </div>
                <div class="user_icon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" width="16" height="16"
                        viewBox="0 0 24 24">
                        <path fill="currentColor"
                            d="M4 4h16v12H5.17L4 17.17zm0-2c-1.1 0-1.99.9-1.99 2L2 22l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm2 10h12v2H6zm0-3h12v2H6zm0-3h12v2H6z" />
                    </svg>
                </div>
            </div>
            <div class="total_number_flx">
                <div class="first_number">
                    <p>10</p>
                </div>
                <ul class="dash_list">
                    {{-- <li>Male: 10</li>
                    <li>Female: 0</li> --}}

                </ul>
            </div>

        </div>
    </div>
@endsection
