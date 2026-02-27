
<div class="modal fade" id="createNewSupportProgram" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" style="font-family: 'Cairo', sans-serif;">إضافة برنامج دعم</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="createSupportProgramForm" method="POST" class="modal_style">
        @csrf
        <div class="modal-body">
            <div class="mb-3">
              <label for="name" class="form-label">اسم البرنامج</label>
              <input name="name" type="text" class="form-control" placeholder="مثال: سلة رمضان، كسوة العيد">
              <span class="text-danger" id="error_name"></span>
            </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success"><i class="fa fa-floppy-o"></i> حفظ</button>
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fa fa-times"></i> إغلاق</button>
        </div>
      </form>
    </div>
  </div>
</div>