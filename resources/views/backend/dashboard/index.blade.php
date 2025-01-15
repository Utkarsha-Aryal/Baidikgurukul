@extends('backend.layouts.main')
@section('title')
    Dashboard
@endsection
@section('styles')
<style>
    canvas {
        display: block;
        width: 100%;
        max-width: 600px;
        margin: 0 auto;
    }

    .sales-card {
        margin: 10px;
        border-radius: 15px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        background-color: #ffffff;
        transition: all 0.3s ease;
        /* background: linear-gradient(to bottom right, #ffffff, #f0f0f0); */
    }

    .sales-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
    }

    .card-title {
        font-size: 1.5rem;
        font-weight: bold;
        color: #505050;
    }

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

    .total-sales {
        /* background: linear-gradient(to bottom right, #ddd1ff, #3ed38d); */
        color: #007bff;
    }

    .year-sales {
        /* background: linear-gradient(to bottom right, #cdfff3, #b58e1a); */
        color: #ffc107;
    }

    .month-sales {
        /* background: linear-gradient(to bottom right, #edf664, #1976d2); */
        color: #28a745;
    }

    .daily-sales {
        /* background: linear-gradient(to bottom right, #f2cccf, #d455b7); */
        color: #dc3545;
    }

    .destination {
        /* background: linear-gradient(to bottom right, #fbfde1, #6f268a); */
        color: #007bff;
    }

    .package {
        /* background: linear-gradient(to bottom right, #cdd7ff, #b5341a); */
        color: #ffc107;
    }

    .trekking {
        /* background: linear-gradient(to bottom right, #f69f64, #19d2cc); */
        color: #28a745;
    }

    .activity {
        /* background: linear-gradient(to bottom right, #f1ccf2, #66d455); */
        color: #dc3545;
    }

    .table-striped tbody tr:nth-of-type(odd) {
        background-color: #f9f9f9;
    }

    .table-striped tbody tr:hover {
        background-color: #f1f1f1;
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

    .chart_fieldvisit_flx {
        background-color: white;
        padding: 20px 30px;
        width: 66%;
        border-radius: 4px;
        box-shadow: 0 0 16px rgba(0, 0, 0, 0.2);
    }


    .chart-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding-block: 20px;
        width: 90%;
    }

    .chart {
        display: flex;
        align-items: flex-end;
        /* Align bars to the bottom */
        justify-content: space-between;
        width: 100%;
        height: 300px;
        position: relative;
    }

    .group {
        display: flex;
        justify-content: space-between;
        width: 9%;
        height: 100%;
        align-items: self-end;
    }

    .bar {
        width: 20px;
        text-align: center;
        color: white;
        font-size: 12px;
        line-height: 1.2;
    }

    .bar.pending {
        background-color: rgba(2, 131, 199, 1);
    }

    .bar.completed {
        background-color: rgba(165, 216, 221, 1);
    }

    .x-axis {
        display: flex;
        justify-content: space-between;
        margin-top: 10px;
        width: 100%;
    }

    .x-axis span {
        color: rgba(157, 157, 157, 1);
    }

    .legend {
        display: flex;
        justify-content: space-around;
        /* margin-top: 20px; */
        width: 300px;
    }

    .legend span {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .legend .color-box {
        width: 12px;
        height: 12px;
        border-radius: 50%;
    }

    .pending-box {
        background-color: #8ecae6;
    }

    .completed-box {
        background-color: #219ebc;
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

    .chart_number_container_flx {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding-top: 70px;
    }

    .chart_numbers {
        width: 10%;
        height: 100%;
        display: flex;
        flex-direction: column;
        gap: 38px;
        margin-bottom: 2rem;
        padding: 0 !important;
    }

    .chart_numbers li {
        font-size: 14px;
        font-weight: 400;
        color: rgba(157, 157, 157, 1);
        list-style-type: none !important;
    }

    .chart_field_wrapper {
        display: flex;
        justify-content: space-between;
        margin-block: 30px;
    }

    .field_notice_wrapper {
        width: 32%;
        display: flex;
        flex-direction: column;
        gap: 30px;
    }

    .field_visit_container {
        background-color: white;
        padding: 20px 20px;
        box-shadow: 0 0 16px rgba(0, 0, 0, 0.2);
        border-radius: 4px;

    }

    .first_visit_txt p {
        font-size: 16px;
        font-weight: 500;
    }

    .first_flx {
        display: flex;
        align-items: center;
        justify-content: space-between;
        border-bottom: 0.5px solid rgba(217, 217, 217, 1);

    }

    .name_txt p {
        font-size: 14px;
        font-weight: 400;
        position: relative;

        &::before {
            position: absolute;
            content: " ";
            height: 80%;
            width: 2px;
            border-radius: 4px;
            background-color: #007bff;
            left: -10px;

        }
    }

    .qnty_flx p {
        font-size: 14px;
        font-weight: 400;
        color: rgba(157, 157, 157, 1);
    }

    .qnty_flx1 p {
        font-size: 14px;
        font-weight: 400;
    }

    .second_flx {
        display: flex;
        justify-content: space-between;
        margin-block: 15px;
    }

    .second_image_txt_flx {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 10px;
    }

    .image_container {
        height: 100%;
        width: 35px;

        img {
            border-radius: 50%;
            height: 100%;
            width: 100%;
        }
    }

    .txt_container p {
        &:nth-child(1) {
            font-size: 12px;
            font-weight: 400;
            margin: 0;
        }

        &:nth-child(2) {
            font-size: 12px;
            font-weight: 400;
            color: #7f7b7a;
            margin: 0;
        }
    }

    .notice_wrapper_container {
        background-color: white;
        padding: 20px 20px;
        box-shadow: 0 0 16px rgba(0, 0, 0, 0.2);
        border-radius: 4px;

    }

    .notice_txt p {
        font-size: 14px;
        font-weight: 500;
    }

    .notice_date_flx {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-block: 10px;
    }

    .notice_txt p {
        font-size: 14px;
        font-weight: 500;
        margin: 0;
    }

    .notice_date_icon {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;

        .bi {
            height: 15px;
            width: 15px;

        }

        P {
            font-size: 14px;
            font-weight: 500;
            margin: 0;

        }

    }

    .notice_grey_txt p {
        font-size: 14px;
        font-weight: 400;
        color: #7f7b7a;
        margin-bottom: 10px !important;
        margin-block: 0;

    }

    .view_more {
        border: none;
        background: white;
        padding: 0;
        margin: 0;

        a {
            display: flex;
            align-items: center;
            gap: 8px;

            p {
                font-size: 14px;
                font-weight: 400;
                color: #08c;
                margin: 0;
            }

            .bi {
                color: #08c;
                height: 12px;
                width: 12px;
            }
        }
    }

    .notice_wrapper_wrap {
        margin-bottom: 10px;
    }

    .content_scroll {
        /* max-height: 250px; */
        overflow-y: auto;
        margin-top: 10px;
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
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
                        <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.24 2.24 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5" />
                    </svg>
                </div>
            </div>
            <div class="total_number_flx">
                <div class="first_number">
                    <p>5</p>
                </div>
                <ul class="dash_list">
                    <li>Male: 2 </li>
                    <li>Female: 2</li>
                    {{-- <li>Admin: {{$admin}}</li> --}}
                </ul>
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
                    <li>Male: 10</li>
                    <li>Female: 0</li>
    
                </ul>
            </div>
    
        </div>
    </div>
@endsection
