<button type="button" 
        class="btn btn-lg rounded-pill waves-effect waves-light show-history-btn" 
        data-id="{{ $difficultCaseFamily->id }}" 
        data-name="{{ $difficultCaseFamily->first_name_ar . ' ' . $difficultCaseFamily->last_name_ar }}"
        title="سجل المساعدات">
    <i class="fa fa-shopping-cart"></i>
</button>
{{-- @can('معاينة تفاصيل الأسرة') --}}
<a href="{{route('admin.difficult-case-families.show',$difficultCaseFamily)}}" class="btn btn-lg  rounded-pill waves-effect waves-light " title=" معاينة "><i class="fa fa-eye"></i> </a>
{{-- @endcan --}}
{{-- @can('تعديل أسرة') --}}
<a href="{{route('admin.difficult-case-families.edit',$difficultCaseFamily)}}" class="btn btn-lg rounded-pill waves-effect waves-light" title=" تعديل "><i class="fa fa-pencil-square-o"></i> </a>
{{-- @endcan --}}
{{-- @can('حذف أسرة') --}}
<a data-bs-toggle="modal" data-bs-target="#delete_family{{$difficultCaseFamily->id}}" class="btn btn-lg rounded-pill waves-effect waves-light" title=" حذف "><i class="fa fa-trash"></i> </a>
{{-- @endcan --}}

</td>
</tr>
<div class="modal fade" id="delete_family{{$difficultCaseFamily->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<form action="{{route('admin.difficult-case-families.destroy',$difficultCaseFamily)}}" method="post" class="from-prevent-multiple-submits">
  @csrf
  @method('DELETE')
  <div class="modal-content">
    <div class="modal-header">
      <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">   حذف أسرة فى وضعية صعبة </h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
        <span aria-hidden="true"></span>
      </button>
    </div>
    <div class="modal-body">
      <p style="text-align: right;"> هل أنت متأكد من حذف الأسرة فى وضعية صعبة ؟</p>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-danger" data-bs-dismiss="modal">اغلاق</button>
      <button type="submit" class="btn btn-success button-prevent-multiple-submits">موافق</button>
    </div>
  </div>
</form>
</div>
</div>