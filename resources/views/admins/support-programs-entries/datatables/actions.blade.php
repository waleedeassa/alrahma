<div class="btn-group" role="group" aria-label="أزرار العمليات">
    <a href="{{ route('admin.support-program-entries.show', $entry) }}" class="btn btn-lg rounded-pill waves-effect waves-light" title="معاينة">
        <i class="fa fa-eye"></i>
    </a>
    @can('تعديل سجل استفادة من برامج الدعم')
        <a href="{{ route('admin.support-program-entries.edit', $entry->id) }}" class="btn btn-lg rounded-pill waves-effect waves-light" title="تعديل">
            <i class="fa fa-edit"></i>
        </a>
    @endcan
    @can('حذف سجل استفادة من برامج الدعم')
        <a data-bs-toggle="modal" data-bs-target="#deleteEntry{{ $entry->id }}" class="btn btn-lg rounded-pill waves-effect waves-light" title="حذف">
            <i class="fa fa-trash"></i>
        </a>
    @endcan
</div>

<!-- delete modal -->
<div class="modal fade" id="deleteEntry{{ $entry->id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{ route('admin.support-program-entries.destroy', $entry->id) }}" method="post" id="deleteSupportProgramEntryForm_{{ $entry->id }}" class="from-prevent-multiple-submits">
            @csrf
            @method('DELETE')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">حذف سجل استفادة</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <p style="text-align: right;">
                        هل أنت متأكد من حذف سجل الاستفادة؟
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">إغلاق</button>
                    <button type="submit" class="btn btn-success button-prevent-multiple-submits">موافق</button>
                </div>
            </div>
        </form>
    </div>
</div>
