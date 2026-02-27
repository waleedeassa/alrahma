<div class="modal fade" id="createNewCity" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">اضافة مدينة - جماعة</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form id="createCity"  method="POST" class="modal_style">
              @csrf
              <div class="modal-body">
                  <div class="mb-3">
                      <label for="name" class="form-label">اسم المدينة - الجماعة</label>
                      <input type="text" name="name" class="form-control" id="name">
                      <span class="text-danger" id="error_name"></span>
                  </div>
                  <div class="mb-3">
                      <label for="governorate_id" class="form-label">الاقليم</label>
                      <select name="governorate_id" id="governorate_id" class="form-control">
                          <option value=""> اختر من القائمة </option>
                          @foreach ($governorates as $governorate)
                              <option value="{{ $governorate->id }}">{{ $governorate->name }}</option>
                          @endforeach
                      </select>
                      <span class="text-danger" id="error_governorate_id"></span>
                  </div>
              </div>
              <div class="modal-footer">
                  <button type="submit" class="btn btn-success"><i class="fa fa-floppy-o"></i>&nbsp; اضافة</button>
                  <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fa fa-times"></i>&nbsp; اغلاق</button>
              </div>
          </form>
      </div>
  </div>
</div>