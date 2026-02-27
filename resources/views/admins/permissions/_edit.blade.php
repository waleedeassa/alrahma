<div class="modal fade" id="editPermissionModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">تعديل صلاحية</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="updatePermissionForm" class="modal_style">
        @csrf
        @method('PUT')
        <input type="hidden" name="id" id="edit_id">
        <div class="modal-body">
          <div class="form-group mb-3">
            <label for="name" class="form-label">اسم الصلاحية</label>
            <input name="name" id="edit_name" type="text" class="form-control">
            <span class="text-danger" id="edit_error_name"></span>
          </div>
          <div class="form-group">
            <label for="group_name" class="form-label">اسم المجموعة</label>
            <select name="group_name" id="edit_group_name" class="form-control">
              <option value="" disabled>اختر مجموعة...</option>
              @foreach($groups as $group)
              <option value="{{ $group }}">{{ $group }}</option>
              @endforeach
            </select>
            <span class="text-danger" id="edit_error_group_name"></span>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success"> <i class="fa fa-floppy-o"></i>&nbsp; تحديث</button>
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal"> <i class="fa fa-times"></i>&nbsp; اغلاق</button>
        </div>
      </form>
    </div>
  </div>
</div>