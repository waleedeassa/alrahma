{{-- ملف: admins/support_programs/datatables/actions.blade.php --}}
<button 
    data-id="{{ $program->id }}" 
    data-name="{{ $program->name }}" 
    class="btn btn-lg rounded-pill waves-effect waves-light edit_program" 
    title="تعديل">
    <i class="fa fa-pencil-square-o"></i>
</button>

<button 
    type="button" 
    class="btn btn-lg rounded-pill waves-effect waves-light" 
    data-bs-toggle="modal" 
    data-bs-target="#delete_program{{ $program->id }}"
    title="حذف">
    <i class="fa fa-trash"></i>
</button>

<!-- مودل الحذف -->
<div class="modal fade" id="delete_program{{$program->id}}" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <form id="deleteSupportProgramForm" method="post">
      @csrf
      @method('DELETE')
      <input type="hidden" name="id" value="{{ $program->id }}">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" style="font-family: 'Cairo', sans-serif;">حذف برنامج الدعم</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>هل أنت متأكد من حذف البرنامج: <strong>{{ $program->name }}</strong>؟</p>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> موافق</button>
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fa fa-times"></i> إغلاق</button>
        </div>
      </div>
    </form>
  </div>
</div>