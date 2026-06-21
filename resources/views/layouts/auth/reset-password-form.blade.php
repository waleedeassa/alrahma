<form method="POST" action="{{ route($formAction) }}" id="resetForm" autocomplete="off" novalidate>
    @csrf

    <input type="hidden" name="token" value="{{ $token }}">
    <input type="hidden" name="email" value="{{ $email }}">
    <div class="form-group">
        <label>البريد الإلكتروني</label>
        <input type="email" class="form-control" value="{{ $email }}" disabled>
    </div>

    <div class="form-group">
        <label for="password">كلمة المرور الجديدة</label>
        <input id="password" type="password" name="password" class="form-control @error('password') is-invalid @enderror" autocomplete="new-password">
        @error('password')
            <span class="invalid-feedback">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group">
        <label for="password_confirmation">تأكيد كلمة المرور</label>
        <input id="password_confirmation" type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" autocomplete="new-password">
        @error('password_confirmation')
            <span class="invalid-feedback">{{ $message }}</span>
        @enderror
    </div>

    <button type="submit" class="btn-auth btn-submit">
        <i class="fa fa-lock" aria-hidden="true"></i>
        حفظ كلمة المرور الجديدة
    </button>
</form>

@push('js')
    <script>
        $(document).ready(function() {
            $('#resetForm').validate({
                rules: {
                    password: {
                        required: true,
                        minlength: 8,
                    },
                    password_confirmation: {
                        required: true,
                        equalTo: '#password',
                    },
                },
                messages: {
                    password: {
                        required: 'كلمة المرور مطلوبة',
                        minlength: 'كلمة المرور يجب أن تكون 8 أحرف أو أرقام على الأقل',
                    },
                    password_confirmation: {
                        required: 'تأكيد كلمة المرور مطلوب',
                        equalTo: 'كلمة المرور غير متطابقة',
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
