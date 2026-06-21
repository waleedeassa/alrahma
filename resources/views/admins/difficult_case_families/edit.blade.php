@extends('layouts.master')
@section('title', 'تعديل أسرة فى وضعية صعبة')
@section('breadcrumpTitle', 'تعديل أسرة فى وضعية صعبة')
@section('breadcrump')
    @parent
    <li class="breadcrumb-item">
        <a href="{{ route('admin.difficult-case-families.index') }}" class="default-color">الأسر فى وضعية صعبة</a>
    </li>
    <li class="breadcrumb-item active">تعديل أسرة فى وضعية صعبة</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-xl-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('admin.difficult-case-families.update', $difficultCaseFamily->id) }}" class="modal_style" id="difficultCaseFamilyForm" method="POST" autocomplete="off">
                        @csrf @method('PUT')

                        <h6 style="color: #84BA3F">معلومات الحالة الأساسية</h6><br>
                        <div class="row">
                            <div class="form-group mb-3 col-md-3">
                                <x-inputs.text type="date" name="registration_date" label="تاريخ التسجيل" :value="old('registration_date', $difficultCaseFamily->registration_date)" />
                            </div>
                            <div class="form-group mb-3 col-md-3">
                                <x-inputs.text name="first_name_ar" label="الاسم الشخصي بالعربية" :value="old('first_name_ar', $difficultCaseFamily->first_name_ar)" />
                            </div>
                            <div class="form-group mb-3 col-md-3">
                                <x-inputs.text name="last_name_ar" label="الاسم العائلي بالعربية" :value="old('last_name_ar', $difficultCaseFamily->last_name_ar)" />
                            </div>
                            <div class="form-group mb-3 col-md-3">
                                <x-inputs.text name="first_name_fr" label="الاسم الشخصي بالفرنسية" :value="old('first_name_fr', $difficultCaseFamily->first_name_fr)" />
                            </div>
                            <div class="form-group mb-3 col-md-3">
                                <x-inputs.text name="last_name_fr" label="الاسم العائلي بالفرنسية" :value="old('last_name_fr', $difficultCaseFamily->last_name_fr)" />
                            </div>
                            <div class="form-group mb-3 col-md-3">
                                <x-inputs.text name="national_id_no" label="رقم البطاقة الوطنية" :value="old('national_id_no', $difficultCaseFamily->national_id_no)" />
                            </div>
                            <div class="form-group mb-3 col-md-3">
                                <label class="form-label">النوع</label>
                                <select name="gender" class="form-control">
                                    <option disabled>اختر من القائمة...</option>
                                    @foreach (config('options.gender') as $key => $label)
                                        <option value="{{ $key }}" @if (old('gender') !== null ? old('gender') == $key : $difficultCaseFamily->gender == $key) selected @endif>{{ $label }}</option>
                                    @endforeach
                                </select>
                                @error('gender')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-3 col-md-3">
                                <x-inputs.text type="date" name="birth_date" label="تاريخ الازدياد" :value="old('birth_date', $difficultCaseFamily->birth_date)" />
                            </div>
                            <div class="form-group mb-3 col-md-3">
                                <label class="form-label">المستوى الدراسي</label>
                                <select name="education_level" class="form-control">
                                    <option disabled>اختر من القائمة...</option>
                                    @foreach (config('options.education_level') as $key => $label)
                                        <option value="{{ $key }}" @if (old('education_level') !== null ? old('education_level') == $key : $difficultCaseFamily->education_level == $key) selected @endif>{{ $label }}</option>
                                    @endforeach
                                </select>
                                @error('education_level')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-3 col-md-3">
                                <label class="form-label">عدد أفراد الأسرة</label>
                                <select name="family_members_count" class="form-control">
                                    <option disabled>اختر من القائمة...</option>
                                    @foreach (config('options.number_of_family_members') as $key => $label)
                                        <option value="{{ $key }}" @if (old('family_members_count') !== null ? old('family_members_count') == $key : $difficultCaseFamily->family_members_count == $key) selected @endif>{{ $label }}</option>
                                    @endforeach
                                </select>
                                @error('family_members_count')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-3 col-md-3">
                                <label class="form-label">فئة الحالة</label>
                                <select name="difficult_case_type" id="difficult_case_type" class="form-control">
                                    <option disabled>اختر من القائمة...</option>
                                    @foreach (config('options.difficult_case_type') as $key => $label)
                                        <option value="{{ $key }}" @if (old('difficult_case_type') !== null ? old('difficult_case_type') == $key : $difficultCaseFamily->difficult_case_type == $key) selected @endif>{{ $label }}</option>
                                    @endforeach
                                </select>
                                @error('difficult_case_type')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-3 col-md-3">
                                <label class="form-label">الوضعية الاجتماعية</label>
                                <select name="social_status" class="form-control">
                                    <option disabled>اختر من القائمة...</option>
                                    @foreach (config('options.social_status') as $key => $label)
                                        <option value="{{ $key }}" @if (old('social_status') !== null ? old('social_status') == $key : $difficultCaseFamily->social_status == $key) selected @endif>{{ $label }}</option>
                                    @endforeach
                                </select>
                                @error('social_status')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <h6 style="color: #84BA3F">المعلومات الجغرافية - الإتصال</h6><br>
                        <div class="row">
                            <div class="form-group mb-3 col-md-3">
                                <x-inputs.select name="governorate_id" label="الإقليم" :options="$governorates" :selected="old('governorate_id', $difficultCaseFamily->governorate_id)" />
                            </div>
                            <div class="form-group mb-3 col-md-3">
                                <label class="form-label">المدينة / الجماعة</label>
                                <select name="city_id" id="city_id" class="form-control">
                                    <option disabled>اختر الإقليم أولاً...</option>
                                </select>
                                @error('city_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-3 col-md-3">
                                <x-inputs.text name="phone" label="رقم الهاتف" :value="old('phone', $difficultCaseFamily->phone)" oninput="this.value = this.value.replace(/[^0-9]/g, '');" />
                            </div>
                            <div class="form-group mb-3 col-md-3">
                                <x-inputs.text name="address" label="العنوان الكامل" :value="old('address', $difficultCaseFamily->address)" />
                            </div>
                        </div>

                        <h6 style="color: #84BA3F">معلومات إضافية</h6><br>
                        <div class="row">
                            <div class="form-group mb-3 col-md-3">
                                <label class="form-label">هل استفادت من خدمات المؤسسة سابقاً؟</label>
                                <select name="previously_benefited" class="form-control">
                                    <option value="" disabled>اختر من القائمة...</option>
                                    @foreach (config('options.previously_benefited') as $key => $label)
                                        <option value="{{ $key }}" @if (old('previously_benefited') !== null ? old('previously_benefited') == $key : $difficultCaseFamily->previously_benefited == $key) selected @endif>{{ $label }}</option>
                                    @endforeach
                                </select>
                                @error('previously_benefited')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-3 col-md-3">
                                <label class="form-label">نوع الخدمة المطلوبة</label>
                                <select name="required_service" class="form-control">
                                    <option disabled>اختر من القائمة...</option>
                                    @foreach (config('options.required_service') as $key => $label)
                                        <option value="{{ $key }}" @if (old('required_service') !== null ? old('required_service') == $key : $difficultCaseFamily->required_service == $key) selected @endif>{{ $label }}</option>
                                    @endforeach
                                </select>
                                @error('required_service')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-3 col-md-3">
                                <label class="form-label">منطقة السكن</label>
                                <select name="housing_area" class="form-control">
                                    <option disabled>اختر من القائمة...</option>
                                    @foreach (config('options.housing_area') as $key => $label)
                                        <option value="{{ $key }}" @if (old('housing_area') !== null ? old('housing_area') == $key : $difficultCaseFamily->housing_area == $key) selected @endif>{{ $label }}</option>
                                    @endforeach
                                </select>
                                @error('housing_area')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-3 col-md-3">
                                <label class="form-label">النشاط المهني للمستفيدة</label>
                                <select name="beneficiary_activity" class="form-control">
                                    <option disabled>اختر من القائمة...</option>
                                    @foreach (config('options.beneficiary_activity') as $key => $label)
                                        <option value="{{ $key }}" @if (old('beneficiary_activity') !== null ? old('beneficiary_activity') == $key : $difficultCaseFamily->beneficiary_activity == $key) selected @endif>{{ $label }}</option>
                                    @endforeach
                                </select>
                                @error('beneficiary_activity')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        @php
                            $isAbuseOld = old('difficult_case_type', $difficultCaseFamily->difficult_case_type) == '2';
                        @endphp

                        <div id="abuse_section" style="display: none;">
                            <h6 style="color: #84BA3F">معلومات المتعدي والعنف</h6><br>
                            <div class="row">
                                <div class="form-group mb-3 col-md-3">
                                    <label class="form-label">جنس المتعدي</label>
                                    <select name="aggressor_gender" class="form-control abuse-field" autocomplete="off" data-db-value="{{ $difficultCaseFamily->aggressor_gender }}">
                                        <option value="" disabled>اختر من القائمة...</option>
                                        @foreach (config('options.gender') as $key => $label)
                                            <option value="{{ $key }}" @if ($isAbuseOld ? old('aggressor_gender', $difficultCaseFamily->aggressor_gender) == $key : $difficultCaseFamily->aggressor_gender == $key) selected @endif>{{ $label }}</option>
                                        @endforeach
                                    </select>
                                    @error('aggressor_gender')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group mb-3 col-md-3">
                                    <label class="form-label">علاقة المتعدي بالضحية</label>
                                    <select name="aggressor_relationship" class="form-control abuse-field" autocomplete="off" data-db-value="{{ $difficultCaseFamily->aggressor_relationship }}">
                                        <option value="" disabled>اختر من القائمة...</option>
                                        @foreach (config('options.aggressor_relationship') as $key => $label)
                                            <option value="{{ $key }}" @if ($isAbuseOld ? old('aggressor_relationship', $difficultCaseFamily->aggressor_relationship) == $key : $difficultCaseFamily->aggressor_relationship == $key) selected @endif>{{ $label }}</option>
                                        @endforeach
                                    </select>
                                    @error('aggressor_relationship')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group mb-3 col-md-3">
                                    <label class="form-label">المستوى الدراسي للمتعدي</label>
                                    <select name="aggressor_education_level" class="form-control abuse-field" autocomplete="off" data-db-value="{{ $difficultCaseFamily->aggressor_education_level }}">
                                        <option value="" disabled>اختر من القائمة...</option>
                                        @foreach (config('options.aggressor_education_level') as $key => $label)
                                            <option value="{{ $key }}" @if ($isAbuseOld ? old('aggressor_education_level', $difficultCaseFamily->aggressor_education_level) == $key : $difficultCaseFamily->aggressor_education_level == $key) selected @endif>{{ $label }}</option>
                                        @endforeach
                                    </select>
                                    @error('aggressor_education_level')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group mb-3 col-md-3">
                                    <label class="form-label">الحالة العائلية للمتعدي</label>
                                    <select name="aggressor_family_status" class="form-control abuse-field" autocomplete="off" data-db-value="{{ $difficultCaseFamily->aggressor_family_status }}">
                                        <option value="" disabled>اختر من القائمة...</option>
                                        @foreach (config('options.aggressor_family_status') as $key => $label)
                                            <option value="{{ $key }}" @if ($isAbuseOld ? old('aggressor_family_status', $difficultCaseFamily->aggressor_family_status) == $key : $difficultCaseFamily->aggressor_family_status == $key) selected @endif>{{ $label }}</option>
                                        @endforeach
                                    </select>
                                    @error('aggressor_family_status')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group mb-3 col-md-3">
                                    <label class="form-label">صلة القرابة</label>
                                    <select name="aggressor_kinship" class="form-control abuse-field" autocomplete="off" data-db-value="{{ $difficultCaseFamily->aggressor_kinship }}">
                                        <option value="" disabled>اختر من القائمة...</option>
                                        @foreach (config('options.aggressor_kinship') as $key => $label)
                                            <option value="{{ $key }}" @if ($isAbuseOld ? old('aggressor_kinship', $difficultCaseFamily->aggressor_kinship) == $key : $difficultCaseFamily->aggressor_kinship == $key) selected @endif>{{ $label }}</option>
                                        @endforeach
                                    </select>
                                    @error('aggressor_kinship')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group mb-3 col-md-3">
                                    <label class="form-label">نوع العنف</label>
                                    <select name="violence_type" class="form-control abuse-field" autocomplete="off" data-db-value="{{ $difficultCaseFamily->violence_type }}">
                                        <option value="" disabled>اختر من القائمة...</option>
                                        @foreach (config('options.violence_type') as $key => $label)
                                            <option value="{{ $key }}" @if ($isAbuseOld ? old('violence_type', $difficultCaseFamily->violence_type) == $key : $difficultCaseFamily->violence_type == $key) selected @endif>{{ $label }}</option>
                                        @endforeach
                                    </select>
                                    @error('violence_type')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group mb-3 col-md-3">
                                    <label class="form-label">مكان العنف</label>
                                    <select name="violence_place" class="form-control abuse-field" autocomplete="off" data-db-value="{{ $difficultCaseFamily->violence_place }}">
                                        <option value="" disabled>اختر من القائمة...</option>
                                        @foreach (config('options.violence_place') as $key => $label)
                                            <option value="{{ $key }}" @if ($isAbuseOld ? old('violence_place', $difficultCaseFamily->violence_place) == $key : $difficultCaseFamily->violence_place == $key) selected @endif>{{ $label }}</option>
                                        @endforeach
                                    </select>
                                    @error('violence_place')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group mb-3 col-md-3">
                                    <label class="form-label">توقيت العنف</label>
                                    <select name="violence_time" class="form-control abuse-field" autocomplete="off" data-db-value="{{ $difficultCaseFamily->violence_time }}">
                                        <option value="" disabled>اختر من القائمة...</option>
                                        @foreach (config('options.violence_time') as $key => $label)
                                            <option value="{{ $key }}" @if ($isAbuseOld ? old('violence_time', $difficultCaseFamily->violence_time) == $key : $difficultCaseFamily->violence_time == $key) selected @endif>{{ $label }}</option>
                                        @endforeach
                                    </select>
                                    @error('violence_time')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group mb-3 col-md-3">
                                    <label class="form-label">وتيرة العنف</label>
                                    <select name="violence_frequency" class="form-control abuse-field" autocomplete="off" data-db-value="{{ $difficultCaseFamily->violence_frequency }}">
                                        <option value="" disabled>اختر من القائمة...</option>
                                        @foreach (config('options.violence_frequency') as $key => $label)
                                            <option value="{{ $key }}" @if ($isAbuseOld ? old('violence_frequency', $difficultCaseFamily->violence_frequency) == $key : $difficultCaseFamily->violence_frequency == $key) selected @endif>{{ $label }}</option>
                                        @endforeach
                                    </select>
                                    @error('violence_frequency')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group mb-3 col-md-3">
                                    <label class="form-label">التدخلات المنجزة خارج المؤسسة</label>
                                    <select name="external_interventions" class="form-control abuse-field" autocomplete="off" data-db-value="{{ $difficultCaseFamily->external_interventions }}">
                                        <option value="" disabled>اختر من القائمة...</option>
                                        @foreach (config('options.external_interventions') as $key => $label)
                                            <option value="{{ $key }}" @if ($isAbuseOld ? old('external_interventions', $difficultCaseFamily->external_interventions) == $key : $difficultCaseFamily->external_interventions == $key) selected @endif>{{ $label }}</option>
                                        @endforeach
                                    </select>
                                    @error('external_interventions')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success"><i class="fa fa-floppy-o"></i>&nbsp; تعديل</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {

            const ABUSE_VALUE = '2';

            function toggleAbuseSection(value) {
                const isAbuse = value == ABUSE_VALUE;
                $('#abuse_section').toggle(isAbuse);

                $('.abuse-field').each(function() {
                    const select = $(this);
                    if (isAbuse) {
                        select.rules('add', {
                            required: true,
                            messages: {
                                required: "الحقل مطلوب"
                            }
                        });
                        const dbValue = select.data('db-value');
                        if (dbValue === '' || dbValue === undefined || dbValue === null) {
                            select.prop('selectedIndex', 0);
                        } else {
                            select.val(String(dbValue));
                        }
                    } else {
                        select.rules('remove', 'required');
                        select.prop('selectedIndex', 0).removeClass('is-invalid');
                    }
                });
            }

            $('#difficult_case_type').on('change', function() {
                toggleAbuseSection($(this).val());
            });

            $('#difficultCaseFamilyForm').on('submit', function() {
                const isAbuse = $('#difficult_case_type').val() == ABUSE_VALUE;
                if (!isAbuse) {
                    $('.abuse-field').val('');
                }
            });

            // ✅ استدعِ .validate() أولاً
            $('#difficultCaseFamilyForm').validate({
                ignore: [],
                rules: {
                    registration_date: {
                        required: true
                    },
                    first_name_ar: {
                        required: true
                    },
                    last_name_ar: {
                        required: true
                    },
                    first_name_fr: {
                        required: true
                    },
                    last_name_fr: {
                        required: true
                    },
                    national_id_no: {
                        required: true
                    },
                    gender: {
                        required: true
                    },
                    birth_date: {
                        required: true
                    },
                    education_level: {
                        required: true
                    },
                    family_members_count: {
                        required: true
                    },
                    difficult_case_type: {
                        required: true
                    },
                    social_status: {
                        required: true
                    },
                    governorate_id: {
                        required: true
                    },
                    city_id: {
                        required: true
                    },
                    address: {
                        required: true
                    },
                    phone: {
                        required: true
                    },
                    previously_benefited: {
                        required: true
                    },
                    required_service: {
                        required: true
                    },
                    housing_area: {
                        required: true
                    },
                    beneficiary_activity: {
                        required: true
                    },
                },
                messages: {
                    registration_date: {
                        required: 'الحقل مطلوب'
                    },
                    first_name_ar: {
                        required: 'الحقل مطلوب'
                    },
                    last_name_ar: {
                        required: 'الحقل مطلوب'
                    },
                    first_name_fr: {
                        required: 'الحقل مطلوب'
                    },
                    last_name_fr: {
                        required: 'الحقل مطلوب'
                    },
                    national_id_no: {
                        required: 'الحقل مطلوب'
                    },
                    gender: {
                        required: 'الحقل مطلوب'
                    },
                    birth_date: {
                        required: 'الحقل مطلوب'
                    },
                    education_level: {
                        required: 'الحقل مطلوب'
                    },
                    family_members_count: {
                        required: 'الحقل مطلوب'
                    },
                    difficult_case_type: {
                        required: 'الحقل مطلوب'
                    },
                    social_status: {
                        required: 'الحقل مطلوب'
                    },
                    governorate_id: {
                        required: 'الحقل مطلوب'
                    },
                    city_id: {
                        required: 'الحقل مطلوب'
                    },
                    address: {
                        required: 'الحقل مطلوب'
                    },
                    phone: {
                        required: 'الحقل مطلوب'
                    },
                    previously_benefited: {
                        required: 'الحقل مطلوب'
                    },
                    required_service: {
                        required: 'الحقل مطلوب'
                    },
                    housing_area: {
                        required: 'الحقل مطلوب'
                    },
                    beneficiary_activity: {
                        required: 'الحقل مطلوب'
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

            // ✅ الآن استدعِ toggleAbuseSection بعد تهيئة الفورم بالـ validate
            const oldValue = '{{ old('difficult_case_type') }}';
            const dbValue = '{{ $difficultCaseFamily->difficult_case_type }}';
            const currentValue = oldValue !== '' ? oldValue : dbValue;
            if (currentValue) toggleAbuseSection(currentValue);

            // fetchCities to get cities based on governorate

            function fetchCities(governorateId, selectedCityId = null) {
                if (!governorateId) return;
                $.ajax({
                    url: "{{ route('admin.get_cities', '') }}/" + governorateId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        const citySelect = $('select[name="city_id"]');
                        citySelect.empty().append('<option selected disabled>اختر من القائمة...</option>');
                        $.each(data, function(key, value) {
                            citySelect.append('<option value="' + key + '"' + (key == selectedCityId ? ' selected' : '') + '>' + value + '</option>');
                        });
                    },
                });
            }
            $('select[name="governorate_id"]').on('change', function() {
                fetchCities($(this).val());
            });
            var initGov = $('select[name="governorate_id"]').val();
            if (initGov) fetchCities(initGov, "{{ old('city_id', $difficultCaseFamily->city_id) }}");
        });
    </script>
@endpush
