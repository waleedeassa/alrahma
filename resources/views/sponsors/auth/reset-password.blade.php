@extends('layouts.auth.login')
@section('title', 'إعادة تعيين كلمة المرور — الكفلاء')
@section('form_title', 'إعادة تعيين كلمة المرور')

@section('header_icon')
    <div class="icon-wrap">
        <svg viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
            <path d="M20 24a4 4 0 100-8 4 4 0 000 8z" stroke="#296060" stroke-width="2.5" />
            <path d="M20 8v4M20 32v4M8 20h4M32 20h4M11.5 11.5l3 3M25.5 25.5l3 3M11.5 28.5l3-3M25.5 14.5l3-3" stroke="#c4ac7c" stroke-width="1.8" stroke-linecap="round" />
            <path d="M30 30l8 8" stroke="#296060" stroke-width="2.5" stroke-linecap="round" />
            <circle cx="38" cy="38" r="3" fill="#c4ac7c" />
        </svg>
    </div>
@endsection

@section('form')
    @include('layouts.auth.reset-password-form', [
        'formAction' => 'sponsor.reset.password',
        'token' => $token,
        'email' => $email ?? '',
    ])
@endsection
