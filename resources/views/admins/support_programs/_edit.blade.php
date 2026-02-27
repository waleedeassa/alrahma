
<div class="modal fade" id="editSupportProgramModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" style="font-family: 'Cairo', sans-serif;">تعديل برنامج دعم</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="updateSupportProgramForm" method="POST" class="modal_style">
        @csrf
        @method('PUT')
        <input type="hidden" name="id" id="edit_id">
        <div class="modal-body">
            <div class="mb-3">
              <label for="edit_name" class="form-label">اسم البرنامج</label>
              <input name="name" type="text" class="form-control" id="edit_name">
              <span class="text-danger" id="edit_error_name"></span>
            </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success"><i class="fa fa-floppy-o"></i> تحديث</button>
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fa fa-times"></i> إغلاق</button>
        </div>
      </form>
    </div>
  </div>
</div>