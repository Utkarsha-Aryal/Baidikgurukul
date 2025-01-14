{{-- @extends('frontpanel.layouts.design') --}}
@section('front-title')
404 Error Page
@endsection
@section('styles')
<style>
    .page-error-container {
        height: 75vh;
    }

    .card {
        background-color: rgba(255, 255, 255, 0.85);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .card-title {
        font-size: 4rem;
        color: #f09414;
    }

    .card-text {
        font-size: 1.25rem;
    }

    .btn-primary {
        background-color: #007bff;
        border: none;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }
</style>
@endsection

@section('front-content')

<div class="container page-error-container d-flex justify-content-center align-items-center">
    <div class="card text-center p-4">
        <h1 class="card-title"><i class="fa-solid fa-triangle-exclamation fa-bounce" style="color: #f09414;"></i> 404</h1>
        <p class="card-text">Opps!, the page you are looking for could not be found.</p>
    </div>
</div>
@endsection