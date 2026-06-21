<form method="POST" action="{{ route($formAction) }}" id="forgotForm" autocomplete="off" novalidate>
    @csrf

    <p class="form-hint">أدخل بريدك الإلكتروني وسنرسل لك رابط إعادة تعيين كلمة المرور.</p>

    <div class="form-group">
        <label for="email">البريد الإلكتروني</label>
        <input id="email" type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" autocomplete="email">
        @error('email')
            <span class="invalid-feedback">{{ $message }}</span>
        @enderror
    </div>

    <button type="submit" class="btn-auth btn-submit">
        <i class="fa fa-paper-plane" aria-hidden="true"></i>
        إرسال رابط التحقق
    </button>

    <a href="{{ route($backRoute) }}" class="btn-auth btn-back">
        <i class="fa fa-arrow-right" aria-hidden="true"></i>
        رجوع لتسجيل الدخول
    </a>
</form>

@push('js')
    <script>
        $(document).ready(function() {
            $('#forgotForm').validate({
                rules: {
                    email: {
                        required: true,
                        email: true
                    },
                },
                messages: {
                    email: {
                        required: 'البريد الإلكتروني مطلوب',
                        email: 'صيغة البريد الإلكتروني غير صحيحة',
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
