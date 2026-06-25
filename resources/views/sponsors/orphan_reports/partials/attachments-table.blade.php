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
                                    <a class="btn btn-dark btn-sm" href="{{ route('sponsor.view_orphan_report_attachment', $attachment) }}" target="_blank">
                                        <i class="fa fa-eye"></i> عرض
                                    </a>
                                </td>
                            </tr>

                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="alert alert-info text-center">لا توجد مرفقات لهذا التقرير حالياً.</div>
        @endif
    </div>
</div>
