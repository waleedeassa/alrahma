<div class="row mt-4">
    <div class="col-md-12">
        <h6 style="color: #84BA3F; font-weight: bold;">
            <i class="fa fa-paperclip"></i> المرفقات الحالية
        </h6>

        @if ($orphanReport->attachments->count() > 0)
            <div class="table-responsive mt-3">
                <table class="table table-striped table-bordered p-0" style="text-align: center">
                    <thead>
                        <tr class="table-success">
                            <th>#</th>
                            <th>اسم الملف</th>
                            <th>تاريخ الإضافة</th>
                            <th>العمليات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orphanReport->attachments as $attachment)
                            <tr style="text-align:center; vertical-align:middle">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $attachment->original_name }}</td>
                                <td>{{ $attachment->created_at->diffForHumans() }}</td>
                                <td>
                                    <a class="btn btn-dark btn-sm" href="{{ route('admin.view_orphan_report_attachment', $attachment) }}" target="_blank">
                                        <i class="fa fa-eye"></i> عرض
                                    </a>
                                    <a class="btn btn-success btn-sm" href="{{ route('admin.download_orphan_report_attachment', $attachment) }}">
                                        <i class="fa fa-cloud-download"></i> تحميل
                                    </a>
                                    {{-- زر الحذف فقط خارج صفحة الـ show --}}
                                    @unless (isset($readonly))
                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteAttachment{{ $attachment->id }}">
                                            <i class="fa fa-trash"></i> حذف
                                        </button>
                                    @endunless
                                </td>
                            </tr>

                            {{-- Modal حذف --}}
                            @unless (isset($readonly))
                                <div class="modal fade" id="deleteAttachment{{ $attachment->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" style="font-family: 'Cairo', sans-serif;">حذف المرفق</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('admin.delete_orphan_report_attachment', $attachment) }}" method="POST">
                                                @csrf
                                                <div class="modal-body">
                                                    هل أنت متأكد من حذف المرفق؟
                                                    <input type="hidden" name="id" value="{{ $attachment->id }}">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">إغلاق</button>
                                                    <button type="submit" class="btn btn-success">موافق</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endunless
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="alert alert-info text-center">لا توجد مرفقات لهذا التقرير حالياً.</div>
        @endif
    </div>
</div>
