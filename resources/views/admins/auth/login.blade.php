@extends('layouts.auth.login')
@section('title', 'تسجيل دخول الإدارة')
@section('form_title', 'تسجيل دخول الإدارة')

@section('header_icon')
    <div class="icon-wrap">
        <svg viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
            <circle cx="24" cy="13" r="6.5" stroke="#296060" stroke-width="2.4" />
            <path d="M10 38c0-7.18 6.268-13 14-13s14 5.82 14 13" stroke="#296060" stroke-width="2.4" stroke-linecap="round" />
            <path d="M24 22l-6 2.5v5c0 3.5 2.5 6.5 6 7.5 3.5-1 6-4 6-7.5v-5L24 22z" fill="#eef5f5" stroke="#c4ac7c" stroke-width="1.8" stroke-linejoin="round" />
            <path d="M21 30l2.5 2.5 4-4" stroke="#296060" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
    </div>
@endsection

@section('form')
    @include('layouts.auth.auth-form', [
        'formAction' => 'admin.check',
        'backRoute' => 'home',
        'forgotRoute' => 'admin.forget.password.form',
    ])
@endsection
