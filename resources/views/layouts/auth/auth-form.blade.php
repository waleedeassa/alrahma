<form method="POST" action="{{ route($formAction) }}" id="authForm" autocomplete="off" novalidate>
    @csrf

    <div class="form-group">
        <label for="email">البريد الإلكتروني</label>
        <input id="email" type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" autocomplete="username">
        @error('email')
            <span class="invalid-feedback">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group">
        <label for="password">كلمة المرور</label>
        <input id="password" type="password" name="password" class="form-control @error('password') is-invalid @enderror" autocomplete="current-password">
        @error('password')
            <span class="invalid-feedback">{{ $message }}</span>
        @enderror
    </div>

    <button type="submit" class="btn-auth btn-submit">
        <i class="fa fa-check" aria-hidden="true"></i>
        تسجيل الدخول
    </button>

    <a href="{{ route($backRoute) }}" class="btn-auth btn-back">
        <i class="fa fa-arrow-right" aria-hidden="true"></i>
        رجوع
    </a>

    <p class="forgot-link">
        <a href="{{ route($forgotRoute) }}">هل نسيت كلمة المرور؟</a>
    </p>
</form>

@push('js')
    <script>
        $(document).ready(function() {
            $('#authForm').validate({
                rules: {
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true
                    },
                },
                messages: {
                    email: {
                        required: 'البريد الإلكتروني مطلوب',
                        email: 'صيغة البريد الإلكتروني غير صحيحة',
                    },
                    password: {
                        required: 'كلمة المرور مطلوبة'
                    },
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(el) {
                    $(el).addClass('is-invalid');
                },
                unhighlight: function(el) {
                    $(el).removeClass('is-invalid');
                },
            });
        });
    </script>
@endpush
