<div class="btn-group" role="group" aria-label="أزرار العمليات">
  <a href="{{route('admin.orphans.show',$orphan)}}" class="btn btn-lg rounded-pill waves-effect waves-light" title=" معاينة ">
    <i class="fa fa-eye"></i>
  </a>
  @can('تعديل يتيم')
  <a href="{{route('admin.orphans.edit',$orphan)}}" class="btn btn-lg rounded-pill waves-effect waves-light" title=" تعديل ">
    <i class="fa fa-edit"></i>
  </a>
  @endcan
  @can('حذف يتيم')
  @if($orphan->sponsorship_status !== 1)
  <a data-bs-toggle="modal" data-bs-target="#delete_orphan{{ $orphan->id }}" class="btn btn-lg rounded-pill waves-effect waves-light" title="حذف">
    <i class="fa fa-trash"></i>
  </a>
  @else
  <a class="btn btn-lg rounded-pill" title="لا يمكن حذف يتيم مكفول" data-bs-toggle="tooltip" data-bs-placement="top">
    <i class="fa fa-trash text-muted"></i>
  </a>
  @endif
  @endcan

  @can('إيقاف يتيم')
  @if($orphan->sponsor_id != null)
  <a data-bs-toggle="modal" data-bs-target="#changeStatus_orphan{{$orphan->id}}" class="btn btn-lg rounded-pill waves-effect waves-light" title="تغيير حالة اليتيم الى موقوف">
    <i class="fa fa-thumbs-down"></i>
  </a>
  @else
  <button class="btn btn-lg rounded-pill disabled" style="pointer-events: none;">
    <i class="fa fa-thumbs-down" style="opacity: 0.3;"></i>
  </button>
  @endif
  @endcan

  @can('إنهاء كفالة يتيم')
  @if($orphan->sponsorship_status == 1)
  <a data-bs-toggle="modal" data-bs-target="#endStatus_orphan{{$orphan->id}}" class="btn btn-lg rounded-pill waves-effect waves-light" title="إنهاء كفالة اليتيم">
    <i class="fa fa-ban"></i>
  </a>
  @else
  <button class="btn btn-lg rounded-pill disabled" style="pointer-events: none;">
    <i class="fa fa-ban" style="opacity: 0.3;"></i>
  </button>
  @endif
  @endcan
</div>
</td>

</tr>

<div class="modal fade" id="delete_orphan{{$orphan->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form action="{{route('admin.orphans.destroy',$orphan)}}" method="post" id="deleteOrphanForm_{{ $orphan->id }}" class="from-prevent-multiple-submits">
      @csrf
      @method('DELETE')
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"> حذف يتيم </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"></span>
          </button>
        </div>
        <div class="modal-body">
          <p style="text-align: right;"> هل أنت متأكد من حذف اليتيم : <strong>{{ $orphan->name_ar }} {{ $orphan->family_name_ar }}</strong> ؟</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">اغلاق</button>
          <button type="submit" class="btn btn-success button-prevent-multiple-submits">موافق</button>
        </div>
      </div>
    </form>
  </div>
</div>
{{-- change status modal --}}
<div class="modal fade" id="changeStatus_orphan{{$orphan->id}}" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <form data-url="{{ route('admin.change.orphan-status-to-unsponsored',$orphan) }}" class="change-status-form modal_style" data-id="{{ $orphan->id }}">
      @csrf
      @method('PATCH')
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">ايقاف كفالة اليتيم</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label class="form-label d-block" style="text-align: right;">
              سبب ايقاف الكفالة <span class="text-danger">*</span>
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
{{-- end status modal --}}
<div class="modal fade" id="endStatus_orphan{{$orphan->id}}" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <form data-url="{{ route('admin.change.orphan-status-to-ended',$orphan) }}" class="change-ended-status-form modal_style" data-id="{{ $orphan->id }}">
      @csrf
      @method('PATCH')
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">إنهاء كفالة اليتيم</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <p style="text-align: right;"> هل أنت متأكد من انهاء كفالة اليتيم ؟</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">إغلاق</button>
          <button type="submit" class="btn btn-success">موافق</button>
        </div>
      </div>
    </form>
  </div>
</div>