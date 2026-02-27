{{-- @can('إضافة يتيم') --}}
<a href="{{route('admin.orphans.create',$family)}}" class="btn btn-lg rounded-pill waves-effect waves-light " title=" اضافة يتيم "><i class="fa fa-user-plus"></i> </a>
{{-- @endcan --}}
{{-- @can('اضافة برنامج دعم للأسرة')
<a href="{{route('admin.family-support.create',$family)}}" class="btn btn-dark btn-sm rounded-pill waves-effect waves-light " title=" اضافة برنامج دعم "><i class="fa fa-gift"></i> </a>
@endcan --}}
{{-- @can('معاينة تفاصيل الأسرة') --}}
<a href="{{route('admin.family-report.create',$family)}}" class="btn btn-lg  rounded-pill waves-effect waves-light " title=" اضافة تقرير دورى "><i class="fa fa-file-text"></i> </a>

<a href="{{route('admin.families.show',$family)}}" class="btn btn-lg  rounded-pill waves-effect waves-light " title=" معاينة  تفاصيل الأسرة "><i class="fa fa-eye"></i> </a>
{{-- @endcan --}}
{{-- @can('تعديل أسرة') --}}
<a href="{{route('admin.families.edit',$family)}}" class="btn btn-lg rounded-pill waves-effect waves-light" title=" تعديل "><i class="fa fa-pencil-square-o"></i> </a>
{{-- @endcan --}}
{{-- @can('حذف أسرة') --}}
<a data-bs-toggle="modal" data-bs-target="#delete_family{{$family->id}}" class="btn btn-lg rounded-pill waves-effect waves-light" title=" حذف "><i class="fa fa-trash"></i> </a>
{{-- @endcan --}}

</td>
</tr>
<div class="modal fade" id="delete_family{{$family->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<form action="{{route('admin.families.destroy',$family)}}" method="post" class="from-prevent-multiple-submits">
  @csrf
  @method('DELETE')
  <div class="modal-content">
    <div class="modal-header">
      <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel"> حذف أسرة </h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
        <span aria-hidden="true"></span>
      </button>
    </div>
    <div class="modal-body">
      <p style="text-align: right;"> هل أنت متأكد من حذف الأسرة ؟</p>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-danger" data-bs-dismiss="modal">اغلاق</button>
      <button type="submit" class="btn btn-success button-prevent-multiple-submits">موافق</button>
    </div>
  </div>
</form>
</div>
</div>