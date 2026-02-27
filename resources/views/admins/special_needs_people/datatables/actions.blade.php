<button type="button" 
        class="btn btn-lg rounded-pill waves-effect waves-light show-history-btn" 
        data-id="{{ $specialNeedsPerson->id }}" 
        data-name="{{ $specialNeedsPerson->first_name_ar . ' ' . $specialNeedsPerson->last_name_ar }}"
        title="سجل المساعدات">
    <i class="fa fa-shopping-cart"></i>
</button>
{{-- @can('معاينة تفاصيل الحالة') --}}
<a href="{{route('admin.special-needs-people.show',$specialNeedsPerson)}}" class="btn btn-lg  rounded-pill waves-effect waves-light " title=" معاينة "><i class="fa fa-eye"></i> </a>
{{-- @endcan --}}
{{-- @can('تعديل حالة') --}}
<a href="{{route('admin.special-needs-people.edit',$specialNeedsPerson)}}" class="btn btn-lg rounded-pill waves-effect waves-light" title=" تعديل "><i class="fa fa-pencil-square-o"></i> </a>
{{-- @endcan --}}
{{-- @can('حذف حالة') --}}
<a data-bs-toggle="modal" data-bs-target="#delete_special_needs{{$specialNeedsPerson->id}}" class="btn btn-lg rounded-pill waves-effect waves-light" title=" حذف "><i class="fa fa-trash"></i> </a>
{{-- @endcan --}}

</td>
</tr>
<div class="modal fade" id="delete_special_needs{{$specialNeedsPerson->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form action="{{route('admin.special-needs-people.destroy',$specialNeedsPerson)}}" method="post" class="from-prevent-multiple-submits">
      @csrf
      @method('DELETE')
      <div class="modal-content">
        <div class="modal-header">
          <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">حذف حالة مرضية / احتياج خاص</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"></span>
          </button>
        </div>
        <div class="modal-body">
          <p style="text-align: right;">هل أنت متأكد من حذف الحالة ؟</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">اغلاق</button>
          <button type="submit" class="btn btn-success button-prevent-multiple-submits">موافق</button>
        </div>
      </div>
    </form>
  </div>
</div>