@extends('backend.layouts.main')
@section('title')
    Dashboard
@endsection
@section('main-content')
    <!-- Page Header -->
    <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
        <div>
            <h4 class="mb-0">Welcome To Dashboard {{ Auth::user()->name }}</h4>
        </div>
    </div>
    <!-- End Page Header -->
@endsection
