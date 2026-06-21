@extends('layouts.master')
@section('title', 'اضافة سجل استفادة')
@section('breadcrumpTitle', 'اضافة سجل استفادة')
@section('breadcrump')
    @parent
    <li class="breadcrumb-item">
        <a href="{{ route('admin.support-program-entries.index') }}" class="default-color">سجلات الإستفادة من برامج الدعم</a>
    </li>
    <li class="breadcrumb-item active">اضافة سجل استفادة</li>
@endsection
@push('css')
    <style>
        .section-title {
            color: #84BA3F;
            font-weight: 600;
            margin-bottom: 1.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #84BA3F;
            display: inline-block;
        }

        .dropzone-area {
            background: #f8f9fa;
            border: 2px dashed #dee2e6 !important;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .dropzone-area:hover,
        .dropzone-area.dragover {
            background: #e9ecef;
            border-color: #84BA3F !important;
        }

        .dropzone-area .cursor-pointer {
            cursor: pointer;
            font-weight: 600;
        }

        #attachmentsPreview .preview-item {
            position: relative;
            width: 100px;
            height: 100px;
            border-radius: 8px;
            overflow: hidden;
            border: 1px solid #dee2e6;
        }

        #attachmentsPreview .preview-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        #attachmentsPreview .preview-item .remove-btn {
            position: absolute;
            top: 2px;
            right: 2px;
            background: rgba(220, 53, 69, 0.9);
            color: white;
            border: none;
            border-radius: 50%;
            width: 22px;
            height: 22px;
            font-size: 12px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        #attachmentsPreview .preview-item .remove-btn:hover {
            background: #dc3545;
        }

        .gap-2 {
            gap: 0.5rem;
        }
    </style>
@endpush

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
                    <form action="{{ route('admin.support-program-entries.store') }}" class="modal_style" id="supportProgramEntryForm" method="POST" enctype="multipart/form-data">
                        @csrf
                        <h6 class="section-title">
                            <i class="fa fa-info-circle"></i> معلومات سجل الاستفادة
                        </h6>
                        <div class="row">
                            <div class="form-group mb-3 col-md-3">
                                <label class="form-label">البرنامج <span class="text-danger">*</span></label>
                                <select name="support_program_id" class="form-control @error('support_program_id') is-invalid @enderror">
                                    <option selected disabled>اختر من القائمة...</option>
                                    @foreach ($programs as $program)
                                        <option value="{{ $program->id }}" @selected(old('support_program_id') == $program->id)>{{ $program->name }}</option>
                                    @endforeach
                                </select>
                                @error('support_program_id')
                                    <span class="invalid-feedback d-block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-3 col-md-3">
                                <label class="form-label">الفئة المستفيدة <span class="text-danger">*</span></label>
                                <select name="beneficiary_category" class="form-control @error('beneficiary_category') is-invalid @enderror">
                                    <option selected disabled>اختر من القائمة...</option>
                                    @foreach ($categories as $key => $label)
                                        <option value="{{ $key }}" @selected(old('beneficiary_category') == $key)>{{ $label }}</option>
                                    @endforeach
                                </select>
                                @error('beneficiary_category')
                                    <span class="invalid-feedback d-block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-3 col-md-3">
                                <label class="form-label">تاريخ الاستفادة <span class="text-danger">*</span></label>
                                <input type="date" name="date" class="form-control @error('date') is-invalid @enderror" value="{{ old('date') }}">
                                @error('date')
                                    <span class="invalid-feedback d-block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-3 col-md-3">
                                <label class="form-label">عدد المستفيدين <span class="text-danger">*</span></label>
                                <input type="number" name="beneficiaries_count" class="form-control @error('beneficiaries_count') is-invalid @enderror" value="{{ old('beneficiaries_count') }}" min="1">
                                @error('beneficiaries_count')
                                    <span class="invalid-feedback d-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group mb-3 col-md-3">
                                <label class="form-label">الجهة الممولة <span class="text-danger">*</span></label>
                                <input type="text" name="funding_source" class="form-control @error('funding_source') is-invalid @enderror" value="{{ old('funding_source') }}" placeholder="مثال: وزارة التضامن الاجتماعي">
                                @error('funding_source')
                                    <span class="invalid-feedback d-block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-3 col-md-9">
                                <label class="form-label">ملاحظات</label>
                                <input type="text" name="notes" class="form-control" value="{{ old('notes') }}" placeholder="أي ملاحظات إضافية...">
                                @error('notes')
                                    <span class="text-danger d-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group mb-3 col-md-12">
                                <label class="form-label">المرفقات (صور)</label>
                                <div class="dropzone-area border rounded p-4 text-center" id="dropzoneArea">
                                    <i class="fa fa-cloud-upload fa-2x text-muted mb-2"></i>
                                    <p class="mb-1">اسحب الصور هنا أو <span class="text-primary cursor-pointer" onclick="document.getElementById('attachments').click()">اضغط للاختيار</span></p>
                                    <small class="text-muted">يمكن اختيار أكثر من صورة — الصيغ المسموحة: jpg, jpeg, png, webp</small>
                                    <input type="file" name="attachments[]" id="attachments" class="d-none" multiple accept="image/*">
                                </div>
                                <div id="attachmentsPreview" class="d-flex flex-wrap gap-2 mt-3"></div>
                                <div id="filesCount" class="mt-2 text-muted small d-none">
                                    <i class="fa fa-paperclip"></i> <span id="filesCountText"></span>
                                </div>
                                @error('attachments')
                                    <span class="text-danger d-block mt-2">{{ $message }}</span>
                                @enderror
                                @error('attachments.*')
                                    <span class="text-danger d-block mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="text-right mt-4 pt-3 border-top">
                            <button type="submit" class="btn btn-success">
                                <i class="fa fa-check"></i> حفظ السجل
                            </button>
                            <a href="{{ route('admin.support-program-entries.index') }}" class="btn btn-danger mr-2">
                                <i class="fa fa-times"></i> إلغاء
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {

            const dropzone = document.getElementById('dropzoneArea');
            const fileInput = document.getElementById('attachments');
            const previewContainer = document.getElementById('attachmentsPreview');
            const filesCount = document.getElementById('filesCount');
            const filesCountText = document.getElementById('filesCountText');
            let selectedFiles = [];

            // ── Drag & Drop Events ──
            dropzone.addEventListener('dragover', (e) => {
                e.preventDefault();
                dropzone.classList.add('dragover');
            });

            dropzone.addEventListener('dragleave', () => {
                dropzone.classList.remove('dragover');
            });

            dropzone.addEventListener('drop', (e) => {
                e.preventDefault();
                dropzone.classList.remove('dragover');
                const files = Array.from(e.dataTransfer.files).filter(f => f.type.startsWith('image/'));
                handleFiles(files);
            });

            dropzone.addEventListener('click', (e) => {
                if (e.target.tagName !== 'SPAN') fileInput.click();
            });

            fileInput.addEventListener('change', function() {
                handleFiles(Array.from(this.files));
            });

            // ── handle Files ──
            function handleFiles(files) {
                selectedFiles = [...selectedFiles, ...files];
                updateFileInput();
                renderPreview();
                updateCount();
            }

            function updateFileInput() {
                const dataTransfer = new DataTransfer();
                selectedFiles.forEach(file => dataTransfer.items.add(file));
                fileInput.files = dataTransfer.files;
            }

            function renderPreview() {
                previewContainer.innerHTML = '';
                selectedFiles.forEach((file, index) => {
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        const div = document.createElement('div');
                        div.className = 'preview-item';
                        div.innerHTML = `
                    <img src="${e.target.result}" alt="${file.name}">
                    <button type="button" class="remove-btn" onclick="removeFile(${index})" title="حذف">
                        <i class="fa fa-times"></i>
                    </button>
                `;
                        previewContainer.appendChild(div);
                    };
                    reader.readAsDataURL(file);
                });
            }

            window.removeFile = function(index) {
                selectedFiles.splice(index, 1);
                updateFileInput();
                renderPreview();
                updateCount();
            };

            function updateCount() {
                const count = selectedFiles.length;
                if (count > 0) {
                    filesCount.classList.remove('d-none');
                    filesCountText.textContent = `تم اختيار ${count} صورة`;
                } else {
                    filesCount.classList.add('d-none');
                }
            }

            // ── jQuery Validate ──────────────────────────────────────────────
            $('#supportProgramEntryForm').validate({
                ignore: [],
                rules: {
                    support_program_id: {
                        required: true
                    },
                    beneficiary_category: {
                        required: true
                    },
                    date: {
                        required: true
                    },
                    beneficiaries_count: {
                        required: true,
                        digits: true,
                        min: 1
                    },
                    funding_source: {
                        required: true
                    },
                    'attachments': {
                        extension: 'jpg|jpeg|png|webp'
                    },
                },
                messages: {
                    support_program_id: {
                        required: 'الحقل مطلوب'
                    },
                    beneficiary_category: {
                        required: 'الحقل مطلوب'
                    },
                    date: {
                        required: 'الحقل مطلوب'
                    },
                    beneficiaries_count: {
                        required: 'الحقل مطلوب',
                        digits: 'يجب إدخال رقم صحيح',
                        min: 'يجب أن يكون العدد أكبر من صفر'
                    },
                    funding_source: {
                        required: 'الحقل مطلوب'
                    },
                    'attachments[]': {
                        extension: 'صيغة الملف غير مسموحة، استخدم صورة فقط'
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
