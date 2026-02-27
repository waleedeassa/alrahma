<div class="modal fade" id="createRoleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">إضافة مسؤول جديد</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="createRoleForm" class="modal_style">
        @csrf
        <div class="modal-body d-flex flex-column gap-3">
          <div class="">
            <div class="">
              <label for="name" class="form-label">اسم المسؤول</label>
              <input name="name" type="text" class="form-control">
            </div>
            <span class="text-danger" id="error_name"></span>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success"> <i class="fa fa-floppy-o"></i>&nbsp; حفظ</button>
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal"> <i class="fa fa-times"></i>&nbsp; اغلاق</button>
        </div>
      </form>
    </div>
  </div>
</div>