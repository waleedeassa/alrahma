@extends('layouts.auth.login')
@section('title', 'نسيت كلمة المرور — الكفلاء')
@section('form_title', 'نسيت كلمة المرور')

@section('header_icon')
<div class="icon-wrap">
    <svg viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
        <rect x="10" y="22" width="28" height="20" rx="4" stroke="#296060" stroke-width="2.5"/>
        <path d="M16 22v-6a8 8 0 0116 0v6" stroke="#296060" stroke-width="2.5" stroke-linecap="round"/>
        <circle cx="24" cy="32" r="3" fill="#c4ac7c"/>
        <path d="M24 35v3" stroke="#c4ac7c" stroke-width="2" stroke-linecap="round"/>
    </svg>
</div>
@endsection

@section('form')
    @include('layouts.auth.forgot-password-form', [
        'formAction' => 'sponsor.forget.password.create',
        'backRoute'  => 'sponsor.login',
    ])
@endsection