<div class="modal fade" id="editSponsorModal" tabindex="-1" name="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" name="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">تعديل كفيل</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="" id="updateSponsorForm" method="POST" class="modal_style">
              @csrf
              @method('PUT')
              <input type="hidden" name="id" id="edit_id">
              <div class="modal-body d-flex flex-column gap-3">
                  <div class="">
                      <label for="name" class="form-label">الاسم</label>
                      <input name="name" id="edit_name" type="text" class="form-control">
                      <span class="text-danger" id="edit_error_name"></span>
                  </div>
                  <div class="">
                      <label for="email" class="form-label">البريد الإلكتروني</label>
                      <input name="email" id="edit_email" type="email" class="form-control">
                      <span class="text-danger" id="edit_error_email"></span>
                  </div>
                  <div class="">
                      <label for="phone" class="form-label">الهاتف</label>
                      <input name="phone" id="edit_phone" type="text" class="form-control">
                      <span class="text-danger" id="edit_error_phone"></span>
                  </div>
                  <div class="">
                      <label class="form-label">النوع</label>
                      <select name="type" id="edit_type" class="form-select">
                        @foreach(config('options.sponsor_type') as $key => $label)
                        <option value="{{ $key }}">{{ $label }}</option>
                        @endforeach
                      </select>
                      <span class="text-danger" id="edit_error_type"></span>
                  </div>
                  <div class="">
                      <label class="form-label">الحالة</label>
                      <select name="status" id="edit_status" class="form-select">
                          <option value="1">مفعل</option>
                          <option value="0">غير مفعل</option>
                      </select>
                      <span class="text-danger" id="edit_error_status"></span>
                  </div>
                  <div class="">
                    <label for="address" class="form-label">عنوان الاقامة</label>
                    <input name="address" id="edit_address" type="text" class="form-control">
                    <span class="text-danger" id="error_address"></span>
                </div>
              </div>
              <div class="modal-footer">
                  <button type="submit" class="btn btn-success"><i class="fa fa-floppy-o"></i>&nbsp; تحديث</button>
                  <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fa fa-times"></i>&nbsp; اغلاق</button>
              </div>
          </form>
      </div>
  </div>
</div>