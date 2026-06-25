@extends('layouts.master')
@section('title', 'لوحة التحكم ')
@section('breadcrump', '')
@push('css')
    <style>
        .home-statistics a {
            text-decoration: none;
        }

        .card-statistics {
            border: none;
            border-radius: 15px;
            transition: all 0.35s ease;
            background: #ffffff;
            overflow: hidden;
            position: relative;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .card-statistics:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(41, 96, 96, 0.15);
        }

        .stop-hover:hover {
            transform: none !important;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05) !important;
        }

        .icon-box {
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #296060;
            border-radius: 12px;
            color: white;
            font-size: 20px;
        }

        .counter h6 {
            font-size: 14px;
            color: #666;
            font-weight: 600;
            margin: 0;
        }

        .timer {
            font-weight: 700;
            font-size: 22px;
            color: #296060;
            margin: 0;
            line-height: 1.2;
        }
    </style>
@endpush

@section('content')
    <div class="row mb-4">
        <div class="col-12">
            <div class="alert alert-light border-0 shadow-sm d-flex align-items-center" role="alert" style="background: white; border-left: 5px solid #296060 !important;">
                <div class="me-3">
                    <h4 class="alert-heading mb-0" style="font-family: 'Cairo'; color: #296060;">
                        {{ 'مرحبا ' }}, {{ auth()->user()->name }} 👋
                    </h4>
                    <p class="mb-0 mt-1 text-muted">يوم عمل موفق !</p>
                </div>
            </div>
        </div>
    </div>
    {{-- // sponsored orphans  --}}
    <div class="row home-statistics">
        <a class="col-xl-3 col-lg-6 col-md-6 mb-30 d-block" href="{{ route('sponsor.sponsored-orphans') }}">
            <div class="card card-statistics h-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div class="icon-box">
                        <i class="fa fa-child" style="font-size: 25px;"></i>
                    </div>
                    <div class="text-end counter">
                        <h6 class="card-text text-dark" style="font-weight: bold; font-size: 17px;">الأيتام المكفولين</h6>
                        <h6 class="timer" data-to="{{ $sponsoredOrphansCount }}" data-speed="500" style="font-size: 25px;">{{ $sponsoredOrphansCount }}</h6>
                    </div>
                </div>
            </div>
        </a>

        {{-- unsponsored orphans --}}
        <a class="col-xl-3 col-lg-6 col-md-6 mb-30 d-block" href="{{ route('sponsor.unsponsored-orphans') }}">
            <div class="card card-statistics h-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div class="icon-box">
                        <i class="fa fa-user-plus" style="font-size: 25px;"></i>
                    </div>
                    <div class="text-end counter">
                        <h6 class="card-text text-dark" style="font-weight: bold; font-size: 17px;">الأيتام غير المكفولين</h6>
                        <h6 class="timer" data-to="{{ $unsponsoredOrphansCount }}" data-speed="500" style="font-size: 25px;">{{ $unsponsoredOrphansCount }}</h6>
                    </div>
                </div>
            </div>
        </a>
    </div>

@endsection
