<div class="modal fade" id="editRoleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">تعديل مسؤول</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="updateRoleForm" class="modal_style">
        @csrf
        @method('PUT')
        <input type="hidden" name="id" id="edit_id">
        <div class="modal-body d-flex flex-column gap-3">
          <div class="">
            <div class="">
              <label for="name" class="form-label">اسم المسؤول</label>
              <input name="name" type="text" id="edit_name" type="text" class="form-control">
            </div>
            <span class="text-danger" id="edit_error_name"></span>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">تحديث</button>
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">إغلاق</button>
        </div>
      </form>
    </div>
  </div>
</div>