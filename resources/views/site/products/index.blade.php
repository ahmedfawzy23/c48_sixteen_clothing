@extends('site.layouts.app')
@section('title', "Products")

@push('styles')
    <style>
        .search-container {
            background-color: white;
            border-radius: 50px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            padding: 10px;
            max-width: 500px;
            width: 100%;
            transition: all 0.3s ease;
        }

        .search-container:hover {
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
        }

        .form-control.search-input {
            border: none;
            background: transparent;
            padding-left: 20px;
            font-size: 1rem;
            height: 50px;
        }

        .form-control.search-input:focus {
            box-shadow: none;
            outline: none;
        }

        .btn-search {
            background-color: #007bff;
            color: white;
            border-radius: 50px;
            padding: 10px 20px;
            border: none;
            transition: all 0.3s ease;
        }

        .btn-search:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }

        .search-icon {
            color: #6c757d;
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
        }
    </style>
@endpush

@section('content')
    <!-- Page Content -->
    <div class="page-heading products-heading header-text">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="text-content">
                        <h4>new arrivals</h4>
                        <h2>sixteen products</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <livewire:product-search />

@endsection