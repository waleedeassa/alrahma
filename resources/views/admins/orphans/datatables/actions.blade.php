{{-- @can('معاينة تفاصيل يتيم') --}}
<a href="{{route('admin.orphans.show',$orphan)}}" class="btn btn-lg rounded-pill waves-effect waves-light" title=" معاينة "><i class="fa fa-eye"></i> </a>
{{-- @endcan --}}
{{-- @can('تعديل يتيم') --}}
<a href="{{route('admin.orphans.edit',$orphan)}}" class="btn btn-lg rounded-pill waves-effect waves-light" title=" تعديل "><i class="fa fa-edit"></i> </a>
{{-- @endcan --}}
{{-- @can('حذف يتيم') --}}
<a data-bs-toggle="modal" data-bs-target="#delete_orphan{{$orphan->id}}" class="btn btn-lg rounded-pill waves-effect waves-light" title=" حذف ">
  <i class="fa fa-trash"></i>
</a>
{{-- @can('تغيير حالة اليتيم إلى غير مكفول') --}}
@if($orphan->sponsor_id != null)
<a data-bs-toggle="modal" data-bs-target="#changeStatus_orphan{{$orphan->id}}" class="btn btn-lg rounded-pill waves-effect waves-light" title=" تغيير حالة اليتيم إلى غير مكفول  "><i class="fa fa-thumbs-down"></i> </a>
@else
<button class="btn disabled " style="display: inline-block; width: 2.375rem; height: 2.375rem; background-color: transparent; border-radius: 50%;"></button>
@endif
{{-- @endcan --}}

{{-- @endcan --}}
</td>

</tr>
<div class="modal fade" id="delete_orphan{{$orphan->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form action="{{route('admin.orphans.destroy',$orphan)}}" method="post" class="from-prevent-multiple-submits">
      @csrf
      @method('DELETE')
      <div class="modal-content">
        <div class="modal-header">
          <h5 style="font-orphan: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel"> حذف يتيم </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"></span>
          </button>
        </div>
        <div class="modal-body">
          <p style="text-align: right;"> هل أنت متأكد من حذف اليتيم ؟</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">اغلاق</button>
          <button type="submit" class="btn btn-success button-prevent-multiple-submits">موافق</button>
        </div>
      </div>
    </form>
  </div>
</div>
<div class="modal fade" id="changeStatus_orphan{{$orphan->id}}" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <form data-url="{{ route('admin.change.orphan-status',$orphan) }}" class="change-status-form modal_style" data-id="{{ $orphan->id }}">
      @csrf
      @method('PATCH')
      <div class="modal-content"  >
        <div class="modal-header">
          <h5 class="modal-title">تحويل اليتيم إلى غير مكفول</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body" >
          <div class="form-group" >
           <label class="form-label d-block" style="text-align: right;">
              سبب إلغاء الكفالة <span class="text-danger">*</span>
            </label>
            <select name="cancellation_reason" class=" cancellation-reason">
              <option value="">اختر من القائمة...</option>
              @foreach(config('options.sponsorship_cancellation_reason') as $key => $label)
              <option value="{{ $key }}">{{ $label }}</option>
              @endforeach
            </select>
            <div class="text-danger error-message d-none mt-1" style="text-align: right !important; display:block;"></div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">اغلاق</button>
          <button type="submit" class="btn btn-success">موافق</button>
        </div>
      </div>
    </form>
  </div>
</div>
{{-- <div class="modal fade" id="changeStatus_orphan{{$orphan->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form action="{{route('admin.change.orphan-status',$orphan)}}" method="get">
      <div class="modal-content">
        <div class="modal-header">
          <h5 style="font-orphan: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">تحويل اليتيم إلى غير مكفول</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"></span>
          </button>
        </div>
        <div class="modal-body">
          <p style="text-align: right;"> هل أنت متأكد من تحويل اليتيم إلى غير مكفول ؟</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">اغلاق</button>
          <button type="submit" class="btn btn-success button-prevent-multiple-submits">موافق</button>
        </div>
      </div>
    </form>
  </div>
</div> --}}