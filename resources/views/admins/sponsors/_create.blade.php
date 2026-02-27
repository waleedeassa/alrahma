<div class="modal fade" id="createSponsorModal" tabindex="-1" name="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" name="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">إضافة كفيل</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="" id="createSponsorForm" method="POST" class="modal_style">
              @csrf
              <div class="modal-body d-flex flex-column gap-3">
                  <div class="">
                      <label for="name" class="form-label">الاسم</label>
                      <input name="name" type="text" class="form-control">
                      <span class="text-danger" id="error_name"></span>
                  </div>
                  <div class="">
                      <label for="email" class="form-label">البريد الإلكتروني</label>
                      <input name="email" type="email" class="form-control">
                      <span class="text-danger" id="error_email"></span>
                  </div>
                  <div class="">
                      <label for="phone" class="form-label">الهاتف</label>
                      <input name="phone" type="text" class="form-control">
                      <span class="text-danger" id="error_phone"></span>
                  </div>
                  <div class="">
                      <label class="form-label">النوع</label>
                      <select name="type" class="form-select">
                          <option value="" selected disabled>اختر من القائمة...</option>
                          @foreach(config('options.sponsor_type') as $key => $label)
                          <option value="{{ $key }}">{{ $label }}</option>
                          @endforeach
                      </select>
                      <span class="text-danger" id="error_type"></span>
                  </div>
                  <div class="">
                    <label for="address" class="form-label">عنوان الاقامة</label>
                    <input name="address" type="text" class="form-control">
                    <span class="text-danger" id="error_address"></span>
                </div>
              </div>
              <div class="modal-footer">
                  <button type="submit" class="btn btn-success"><i class="fa fa-floppy-o"></i>&nbsp; حفظ</button>
                  <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fa fa-times"></i>&nbsp; اغلاق</button>
              </div>
          </form>
      </div>
  </div>
</div>