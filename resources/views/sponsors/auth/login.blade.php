@extends('layouts.auth.login')
@section('title', 'تسجيل دخول الكفلاء')
@section('form_title', 'تسجيل دخول الكفلاء')

@section('header_icon')
    <div class="icon-wrap">
        <svg viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
            <path d="M24 15c0 0-1.5-3.5-5-3.5A5 5 0 0014 17c0 5 10 12 10 12s10-7 10-12a5 5 0 00-5-5.5c-3.5 0-5 3.5-5 3.5z" fill="#eef5f5" stroke="#c4ac7c" stroke-width="1.8" stroke-linejoin="round" />
            <path d="M10 34h5l3-3h8l5 1" stroke="#296060" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" />
            <path d="M10 34v4h4v-4" stroke="#296060" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            <path d="M31 32l5-1.5a2 2 0 011 3.5L24 38H10" stroke="#296060" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
    </div>
@endsection

@section('form')
    @include('layouts.auth.auth-form', [
        'formAction' => 'sponsor.check',
        'backRoute' => 'home',
        'forgotRoute' => 'sponsor.forget.password.form',
    ])
@endsection
