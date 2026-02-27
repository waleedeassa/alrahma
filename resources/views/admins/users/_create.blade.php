<div class="modal fade  " id="createNewUser" tabindex="-1" name="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" name="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
          اضافة مستخدم
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"></span>
        </button>
      </div>
      <form action="" id="createUser" method="POST" class="modal_style" >
        @csrf
        <div class="modal-body d-flex flex-column gap-3">
          <div class="">
            <div class="">
              <label for="name" class="form-label">الاسم</label>
              <input name="name" type="text" class="form-control">
            </div>
            <span class="text-danger" id="error_name"></span>
          </div>
          <div class="">
            <div class="">
              <label for="family_name" class="form-label">اسم العائلة</label>
              <input name="family_name" type="text" class="form-control">
            </div>
            <span class="text-danger" id="error_family_name"></span>
          </div>
          <div class="">
            <div class="">
              <label for="email" class="form-label">البريد الالكترونى</label>
              <input name="email" type="text" class="form-control">
            </div>
            <span class="text-danger" id="error_email"></span>
          </div>
          <div class="">
            <div class="">
              <label for="phone" class="form-label">رقم الهاتف</label>
              <input name="phone" type="text" class="form-control">
            </div>
            <span class="text-danger" id="error_phone"></span>
          </div>
          <div class="">
            <div class="">
              <label class="form-label" for="exampleFormControlSelect1">الصفة</label>
              <select name="role_id" id="role_id">
                <option value="" selected disabled>اختر من القائمة...</option>
                @foreach ($roles as $role)
                  <option value="{{ $role->id }}">{{ $role->name }}</option>
                @endforeach
              </select>
              <span class="text-danger" id="error_role_id"></span>
            </div>
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